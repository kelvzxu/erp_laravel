<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Models\Partner\res_partner;
use App\Models\Merchandises\purchases_order;
use App\Models\Merchandises\purchases_order_products;
use App\Models\Merchandises\Purchase;
use App\Models\Merchandises\receipt_product;
use App\Models\Merchandises\PurchaseProduct;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\access_right;
use App\User;
use PDF;

class PurchasesOrdersController extends Controller
{
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $orders = purchases_order::with('partner','sales')
                    ->orderBy('created_at', 'desc')
                    ->paginate(30);
                    // dd($orders);
        return view('purchases.index', compact('access','group','orders'));
    }

    public function create()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $partner = res_partner::orderBy('partner_name', 'asc')->get();
        $product = Product::orderBy('name', 'asc')->where('can_be_purchase','1')->get();
        return view('purchases.create', compact('access','group','product','partner'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'vendor' => 'required|max:255',
            'order_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);
 
        $year=date("Y");
        $prefixcode = "PO-$year-";
        $count = purchases_order::all()->count();
        if ($count==0){
            $Order_no= "$prefixcode"."000001";
        }else {
            $latestPo = purchases_order::orderBy('id','DESC')->first();
            $Order_no = $prefixcode.str_pad($latestPo->id + 1, 6, "0", STR_PAD_LEFT);
        }

        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['qty'] * $product['price'];
            return new purchases_order_products($product);
        });

        if($products->isEmpty()) {
            return response()
            ->json([
                'products_empty' => ['One or more Product is required.']
            ], 422);
        }

        $data = $request->except('products'); 
        $data['order_no'] = $Order_no;
        $data['merchandise'] = Auth::id();
        $data['sub_total'] = $products->sum('total');
        $data['grand_total'] = $data['sub_total'] - $data['discount'];

        $purchases = purchases_order::create($data);

        $purchases->products()->saveMany($products);

        return response()
            ->json([
                'created' => 'success',
                'id' => $purchases->id
            ]);
    }
    
    public function show($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $orders = purchases_order::with('partner','sales','products')->findOrFail($id);
        $receipt = receipt_product::where('purchase_no',$orders->order_no)->first();
        return view('purchases.show', compact('access','group','orders','receipt'));
    }

    public function edit($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $orders = purchases_order::with('partner','sales','products','products.product')->findOrFail($id);
        $receipt = receipt_product::where('purchase_no',$orders->order_no)->first();
        return view('purchases.edit', compact('access','group','orders','receipt'));
    }

    public function confirm($id)
    {
        try{
            $orders = purchases_order::where('id',$id)->first()->update([
                'confirm_date'=>date('Y-m-d'),
                'status' =>"PO"
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
            'vendor' => 'required|max:255',
            'order_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);

        $purchase = purchases_order::findOrFail($id);
        $old_total = $purchase->grand_total;

        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['qty'] * $product['price'];
            return new purchases_order_products($product);
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

        $purchase->update($data);

        purchases_order_products::where('purchases_order_id', $purchase->id)->delete();

        $purchase->products()->saveMany($products);

        return response()
            ->json([
                'updated' => "success",
                'id' => $purchase->id
            ]);
    }
}
