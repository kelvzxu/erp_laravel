<?php

namespace App\Addons\Sales\Controllers;

use App\Http\Requests;
use App\Http\Controllers\controller as Controller;
use Illuminate\Http\Request;
use App\Models\Customer\customer_dept;
use App\Addons\Sales\Models\sales_order;
use App\Addons\Sales\Models\sales_order_product;
use App\Models\Product\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use PDF;
use Partner;
use Inventory;

class SalesOrdersController extends Controller
{
    function calculate_code()
    {
        $year=date("Y");
        $prefixcode = "SL/$year/"; 
        $count = sales_order::where('order_no','like',"%".$prefixcode."%")->count();
        if ($count==0){
            return "$prefixcode"."000001";
        }else {
            return $prefixcode.str_pad($count + 1, 6, "0", STR_PAD_LEFT);
        }
    }
    
    public function index()
    {
        $orders = sales_order::with('partner','sales_person')
                    ->orderBy('created_at', 'desc')
                    ->paginate(30);
        return view('sales.index', compact('orders'));
    }

    public function create()
    {
        $partner = Partner::customer();
        $product = Inventory::can_be_sold();
        return view('sales.create', compact('product','partner'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'customer' => 'required|max:255',
            'order_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);
 
        $Order_no = $this->calculate_code();

        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['qty'] * $product['price'];
            return new sales_order_product($product);
        });

        if($products->isEmpty()) {
            return response()
            ->json([
                'products_empty' => ['One or more Product is required.']
            ], 422);
        }

        $data = $request->except('products'); 
        $data['order_no'] = $Order_no;
        $data['sales'] = Auth::id();
        $data['sub_total'] = $products->sum('total');
        $data['grand_total'] = $data['sub_total'] - $data['discount'];

        $sales = sales_order::create($data);

        $sales->products()->saveMany($products);

        return response()
            ->json([
                'created' => 'success',
                'id' => $sales->id
            ]);
    }

    public function show($id)
    {
        $orders = sales_order::with('partner','sales_person','products')->findOrFail($id);
        return view('sales.show', compact('orders'));
    }

    public function edit($id)
    {
        $orders = sales_order::with('partner','sales_person','products','products.product')->findOrFail($id);
        return view('sales.edit', compact('orders'));
    }

    public function confirm($id)
    {
        try{
            $orders = sales_order::where('id',$id)->first()->update([
                'confirm_date'=>date('Y-m-d'),
                'status' =>"SO"
            ]);
            Toastr::success('Confirm Order Successfully','Success');
        }catch (\Exception $e) {
            Toastr::error('Check In Error!','Something Wrong');
        }
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'customer' => 'required|max:255',
            'order_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);

        $orders = sales_order::findOrFail($id);
        $old_total = $orders->grand_total;

        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['qty'] * $product['price'];
            return new sales_order_product($product);
        });

        if($products->isEmpty()) {
            return response()
            ->json([
                'products_empty' => ['One or more Product is required.']
            ], 422);
        }

        $data = $request->except('products');
        $data['sub_total'] = $products->sum('total');
        $data['grand_total'] = $data['sub_total'] - $data['discount'];

        $orders->update($data);

        sales_order_product::where('sales_order_id', $orders->id)->delete();

        $orders->products()->saveMany($products);

        return response()
            ->json([
                'updated' => "success",
                'id' => $orders->id
            ]);
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
}
