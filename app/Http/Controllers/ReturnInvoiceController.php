<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Sales\return_invoice;
use App\Models\Sales\return_invoice_product;
use App\Models\Customer\res_customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;

class ReturnInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $return_inv = return_invoice::with('user')->orderBy('created_at','DESC')->paginate(25);
        return view('return-inv.index', compact('access','group','return_inv'));
    }
    public function store(Request $request)
    {
        try{
            $year=date("Y");
            $prefixcode = "ReINV-$year-";
            $count = return_invoice::all()->count();
            if ($count==0){
                $return_no= "$prefixcode"."000001";
            }else {
                $latestInv = return_invoice::orderBy('id','DESC')->first();
                $return_no = $prefixcode.str_pad($latestInv->id + 1, 6, "0", STR_PAD_LEFT);
            }
            $products= $request->product;
            $return = return_invoice::insertGetId([   
                'return_no'=>$return_no,
                'invoice_no'=>$request->invoice_no,
                'delivery_no'=>$request->delivery_no,
                'user_id'=>Auth::id(),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            foreach($products as $e => $data){
                echo $request->price[$e];
                $return_detail = return_invoice_product::create([
                    'return_id'=>$return,
                    'name'=>$data,
                    'price'=>$request->price[$e],
                    'qty'=>$request->buy_qty[$e],
                    'return_qty'=>$request->return_qty[$e],
                    'total'=>$request->price[$e] * $request->return_qty[$e],
                ]);
                echo $total=$request->price[$e] * $request->return_qty[$e];
                $product = Product::find($data);
                $oldstock = $product->stock;
                $newstock = $oldstock + $request->return_qty[$e];
    
                Product::where('id',$data)->update([
                    'stock' => $newstock,
                ]);
            }
            $grandTotal = return_invoice_product:: where('return_id',$return)->sum('total');
            $partner = res_customer::findOrFail($request->client);
            $oldbalance = $partner->credit_limit;
            $new_balance = $grandTotal + $oldbalance; 
            $partner->update([
                'credit_limit' => $new_balance,
            ]);
            Toastr::success('Return inv:'.$request->invoice_no.' with delivery_no '.$request->delivery_no.' Success','Success');
            return redirect(route('return-invoice.index'));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }
}
