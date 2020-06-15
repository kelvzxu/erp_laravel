<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer\res_customer;
use App\Models\Product\Product;
use App\Models\Sales\Order;
use App\Models\Sales\Order_detail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;
use Cookie;
use DB;
use PDF;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $orders = order::with('customer')->orderBy('created_at', 'DESC')->paginate(25);
        return view('pos.index', compact('access','group','orders'));
    }
    public function create()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $products = Product::orderBy('created_at', 'DESC')->get();
        $customer = res_customer::orderBy('name', 'DESC')->get();
        return view('pos.create', compact('access','group','products','customer'));
    }
    public function view($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $order = order::with('order_detail.product','customer','sales')->findOrFail($id);
        $order1 = order_detail::with('product')->findOrFail($id);
        return view('pos.view', compact('access','group','order'));
    }
    public function store(Request $request)
    {
        try {
            $year=date("Y");
            $prefixcode = "POS-$year-";
            $count = order::all()->count();
            if ($count==0){
                $invoice_no= "$prefixcode"."000001";
            }else {
                $latestInv = order::orderBy('id','DESC')->first();
                $invoice_no = $prefixcode.str_pad($latestInv->id + 1, 6, "0", STR_PAD_LEFT);
            }
            $products= $request->product;
            $name= $request->name;
            $qty = $request->qty;
            $price = $request->price;
            $order = order::insertGetId([   
                'invoice_no'=>$invoice_no,
                'customer_id'=>$request->client,
                'invoice_date'=>date('Y-m-d H:i:s'),
                'user_id'=>Auth::id(),
                'total'=>$request->total,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            foreach($products as $e => $data){
                $Order_detail = order_detail::create([
                    'order_id'=>$order,
                    'product'=>$data,
                    'name'=>$name[$e],
                    'qty'=>$qty[$e],
                    'price'=>$price[$e],
                    'total'=>(int)$qty[$e]*(int)$price[$e],
                ]);
                $product = Product::find($data);
                $oldstock = $product->stock;
                $newstock = $oldstock - $qty[$e];

                Product::where('id',$data)->update([
                    'stock' => $newstock,
                ]);
            }
            $grandTotal = $Order_detail:: where('order_id',$order)->sum('total');
            order::where('id',$order)->update([
                'total'=>$grandTotal,
                'pay'=>$request->pay,
                'Change'=> $request->pay - $grandTotal,
            ]);
            Toastr::success('Point Of Sale Transaction Success','Success');
            return redirect(route('pos'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }
}
