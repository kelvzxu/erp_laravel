<?php

namespace App\Addons\Sales\Controllers;

use App\Http\Controllers\controller as Controller;
use Illuminate\Http\Request;
use App\Addons\Sales\Models\sales_order;
use App\Addons\Sales\Models\sales_order_product;
use Carbon\Carbon;
use PDF;
use DB;

class SalesOrdersController extends Controller
{
    function calculate_code()
    {
        $year=date("Y");
        $prefixcode = "SO/$year/"; 
        $count = sales_order::where('order_no','like',"%".$prefixcode."%")->count();
        if ($count==0){
            return "$prefixcode"."000001";
        }else {
            return $prefixcode.str_pad($count + 1, 6, "0", STR_PAD_LEFT);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'customer' => 'required|max:255',
            'order_date' => 'required',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1',
        ]);
  
        $Order_no = $this->calculate_code();

        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['price_subtotal'] + $product['price_tax'];
            return new sales_order_product($product);
        });

        if($products->isEmpty()) {
            return response()
            ->json([
                'status' => 'failed',
                'errors' => ['result' => ['One or more Product is required.']]
            ], 422);
        }

        $data = $request->except('products'); 
        $data['order_no'] = $Order_no;

        $sales = sales_order::create($data);

        $sales->products()->saveMany($products);

        return response()->json([
            'status' => 'success',
            'message' => "Order $Order_no Created Successfully"
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'customer' => 'required|max:255',
            'order_date' => 'required',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);

        $orders = sales_order::findOrFail($request->id);
        $old_total = $orders->grand_total;

        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['price_subtotal'] + $product['price_tax'];
            return new sales_order_product($product);
        });

        if($products->isEmpty()) {
            return response()
            ->json([
                'status' => 'failed',
                'errors' => ['result' => ['One or more Product is required.']]
            ], 422);
        }

        $data = $request->except('products');

        $orders->update($data);

        sales_order_product::where('sales_order_id', $orders->id)->delete();

        $orders->products()->saveMany($products);

        return response()->json([
            'status' => 'success',
            'message' => "Order $request->order_no Updated Successfully"
        ]);
    }

    public function updateDelivery(Request $request)
    {
        try{
            foreach ($request->picking_line as $product){
                $order_line = sales_order_product::where('name',$product['product_id'])
                                                    ->where('sales_order_id',$request->order_id)
                                                    ->where('product_uom_qty',$product['qty'])
                                                    ->update([
                                                        'delivery_qty'=>$product['done_qty']
                                                    ]);
            }
            $orders = sales_order::where('id',$request->order_id)->first()->update([
                'picking_validate'=>true,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Successfully"
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getSalesOrder($id)
    {
        try{
            $orders = sales_order::with('partner','sales_person','products','company','products.uom','products.product')->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'result' => $orders
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'result' => []
            ]);
        }
    }

    public function confirm(Request $request)
    {
        try{
            $orders = sales_order::where('id',$request->id)->first()->update([
                'confirm_date'=>date('Y-m-d'),
                'state' =>"sale"
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Confirm Order $request->order_no Successfully"
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delivere(Request $request)
    {
        try{
            $orders = sales_order::where('id',$request->id)->first()->update([
                'picking'=>true,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Delivery Orders Created Successfully"
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function fetchSalesOrder(){
        try {
            $response = sales_order::with('partner','sales_person','partner.currency','company')
                    ->orderBy('created_at', 'desc')
                    ->get();
            return response()->json([
                'status' => 'success',
                'data' => $response
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'data' => []
            ]);
        }
    }

    public function sales_analysis()
    {
        $filter = request()->year . '-' . request()->month;
        $parse = Carbon::parse($filter);
        $array_date = range($parse->startOfMonth()->format('d'), $parse->endOfMonth()->format('d'));
        
        $sales = sales_order::select(DB::raw('date(created_at) as date,sum(grand_total) as total'))
        ->where('created_at', 'LIKE', '%' . $filter . '%')
        ->groupBy(DB::raw('date(created_at)'))->get();

        $data=[];
        foreach ($array_date as $row) {
            $f_date = strlen($row) == 1 ? 0 . $row:$row;
            $date = $filter . '-' . $f_date;
            $total = $sales->firstWhere('date', $date);
            $data[] = [
                'date' =>$date,
                'total' => $total ? $total->total:0
            ];
        }
        return $data;
    }

    public function report()
    {
        $month = date('m');
        $year = date('Y');
        $data = sales_order::with('partner','sales_person')
                    ->orderBy('created_at', 'desc')
                    ->paginate(30);
        $quotation = sales_order::whereMonth('order_date', '=', $month)->whereYear('order_date', '=', $year)->where('status','quotation')->count();
        $invoice = sales_order::whereMonth('order_date', '=', $month)->whereYear('order_date', '=', $year)->where('invoice','False')->count();
        $sales = sales_order::whereMonth('order_date', '=', $month)->whereYear('order_date', '=', $year)->where('status','SO')->sum('grand_total');
        return view('sales.report', compact('data','quotation','invoice','sales'));
    }

    public function print($id)
    {
        $orders = sales_order::with('partner','sales_person','products')->findOrFail($id);
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
                                    ->loadview('reports.sales.sales_pdf', compact('orders'));
        return $pdf->stream();
    }

    public function print_report()
    {
        try{
            $month = date('m');
            $year = date('Y');
            $monthName = date("F", mktime(0, 0, 0, $month, 10));
            $data = sales_order::with('partner','sales_person')
                        ->orderBy('created_at', 'desc')
                        ->paginate(30);
            $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')
                                    ->loadview('reports.sales.sales_order_pdf', compact('monthName','year','data'));
            return $pdf->download();
        } catch (\Exception $e) {
            // Toastr::error($e->getMessage(),'Something Wrong');
            Toastr::error('an unexpected error occurred, please contact Your Support Service','Something Went Wrong');
            return redirect()->back();
        }
    }
}
