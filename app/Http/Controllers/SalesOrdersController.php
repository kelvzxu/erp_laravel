<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Customer\customer_dept;
use App\Models\Sales\sales_order;
use App\Models\Sales\sales_order_product;
use App\Models\Product\Product;
use App\Models\Customer\res_customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;
use PDF;

class SalesOrdersController extends Controller
{
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $orders = sales_order::with('partner','sales_person')
                    ->orderBy('created_at', 'desc')
                    ->paginate(30);
                    // dd($orders);
        return view('sales.index', compact('access','group','orders'));
    }

    public function create()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $partner = res_customer::orderBy('name', 'asc')->get();
        $product = Product::orderBy('name', 'asc')->where('can_be_purchase','1')->get();
        return view('sales.create', compact('access','group','product','partner'));
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
 
        $year=date("Y");
        $prefixcode = "SO-$year-";
        $count = sales_order::all()->count();
        if ($count==0){
            $Order_no= "$prefixcode"."000001";
        }else {
            $latestPo = sales_order::orderBy('id','DESC')->first();
            $Order_no = $prefixcode.str_pad($latestPo->id + 1, 6, "0", STR_PAD_LEFT);
        }

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
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $orders = sales_order::with('partner','sales_person','products')->findOrFail($id);
        return view('sales.show', compact('access','group','orders'));
    }

    public function edit($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $orders = sales_order::with('partner','sales_person','products','products.product')->findOrFail($id);
        return view('sales.edit', compact('access','group','orders'));
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
}
