<?php

namespace App\Addons\Purchase\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Purchase\Models\purchases_order;
use App\Addons\Purchase\Models\purchases_order_products;
use Illuminate\Http\Request;
use PDF;
use Partner;
use Inventory;

class PurchasesOrdersController extends Controller
{
    public function fetchPurchasesOrder(){
        try {
            $response = purchases_order::with('partner','merchandises','partner.currency','company')
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

    public function getPurchasesOrder($id)
    {
        try{
            $response = purchases_order::with('partner','merchandises','products','company','products.uom','products.product')->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'result' => $response
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'result' => []
            ]);
        }
    }

    public function calculate_code(){
        $year=date("Y");
        $prefixcode = "PO/$year/";
        $count = purchases_order::where('order_no','like',"%".$prefixcode."%")->count();
        if ($count==0){
            return "$prefixcode"."000001";
        }else {
            return $prefixcode.str_pad($count + 1, 6, "0", STR_PAD_LEFT);
        } 
    }

    public function store(Request $request){
        $this->validate($request, [
            'vendor' => 'required|max:255',
            'order_date' => 'required',
            'discount' => 'required|numeric|min:0',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);
 
        
        $Order_no = $this->calculate_code();

        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['qty'] * $product['price'];
            return new purchases_order_products($product);
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

        $purchases = purchases_order::create($data);

        $purchases->products()->saveMany($products);

        return response()->json([
            'status' => 'success',
            'message' => "Order $Order_no Created Successfully"
        ]);
    }
    

    public function update(Request $request)
    {
        $this->validate($request, [
            'vendor' => 'required|max:255',
            'order_date' => 'required',
            'discount' => 'required|numeric|min:0',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);

        $purchase = purchases_order::findOrFail($request->id);
        $old_total = $purchase->grand_total;

        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['qty'] * $product['price'];
            return new purchases_order_products($product);
        });

        if($products->isEmpty()) {
            return response()
            ->json([
                'status' => 'failed',
                'errors' => ['result' => ['One or more Product is required.']]
            ], 422);
        }

        $data = $request->except('products');

        $purchase->update($data);

        purchases_order_products::where('purchases_order_id', $purchase->id)->delete();

        $purchase->products()->saveMany($products);

        return response()->json([
            'status' => 'success',
            'message' => "Order $purchase->order_no Updated Successfully"
        ]);
    }

    public function report()
    {
        $month = date('m');
        $year = date('Y');
        $data = purchases_order::with('partner','sales')
                    ->orderBy('created_at', 'desc')
                    ->paginate(30);
        $quotation = purchases_order::whereMonth('order_date', '=', $month)->whereYear('order_date', '=', $year)->where('status','quotation')->count();
        $invoice = purchases_order::whereMonth('order_date', '=', $month)->whereYear('order_date', '=', $year)->where('invoice','False')->count();
        $sales = purchases_order::whereMonth('order_date', '=', $month)->whereYear('order_date', '=', $year)->where('status','PO')->sum('grand_total');
        return view('purchases.report', compact('data','quotation','invoice','sales'));
    }

    public function print($id)
    {
        $orders = purchases_order::with('partner','sales','products')->findOrFail($id);
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
                                    ->loadview('reports.purchases.purchases_pdf', compact('orders'));
        return $pdf->stream();
    }

    public function print_report()
    {
        try{
            $month = date('m');
            $year = date('Y');
            $monthName = date("F", mktime(0, 0, 0, $month, 10));
            $access=access_right::where('user_id',Auth::id())->first();
            $group=user::find(Auth::id());
            $data = purchases_order::with('partner','sales')
                        ->orderBy('created_at', 'desc')
                        ->paginate(30);
            $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')
                                    ->loadview('reports.purchases.purchases_order_pdf', compact('monthName','year','data'));
            return $pdf->download();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('an unexpected error occurred, please contact Your Support Service','Something Went Wrong');
            return redirect()->back();
        }
    }
}
