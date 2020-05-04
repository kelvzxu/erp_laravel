<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Partner\res_partner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\Merchandises\return_purchase;
use App\Models\Merchandises\return_purchase_product;

class ReturnPurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $return_po = return_purchase::with('user')->orderBy('created_at','DESC')->paginate(25);
        return view('return-po.index', compact('return_po'));
    }

    public function store(Request $request)
    {
        try{
            $year=date("Y");
            $prefixcode = "ReINV-$year-";
            $count = return_purchase::all()->count();
            if ($count==0){
                $return_no= "$prefixcode"."000001";
            }else {
                $latestInv = return_purchase::orderBy('id','DESC')->first();
                $return_no = $prefixcode.str_pad($latestInv->id + 1, 6, "0", STR_PAD_LEFT);
            }
            $products= $request->product;
            $return = return_purchase::insertGetId([   
                'return_no'=>$return_no,
                'purchase_no'=>$request->purchase_no,
                'receipt_no'=>$request->receipt_no,
                'user_id'=>Auth::id(),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            foreach($products as $e => $data){
                echo $request->price[$e];
                $return_detail = return_purchase_product::create([
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
                $newstock = $oldstock - $request->return_qty[$e];
    
                Product::where('id',$data)->update([
                    'stock' => $newstock,
                ]);
            }
            $grandTotal = return_purchase_product:: where('return_id',$return)->sum('total');
            $partner = res_partner::findOrFail($request->client);
            $oldbalance = $partner->credit_limit;
            $new_balance = $grandTotal + $oldbalance; 
            $partner->update([
                'credit_limit' => $new_balance,
            ]);
            Toastr::success('Return po:'.$request->purchase_no.' with receive_no '.$request->receipt_no.' Success','Success');
            // return redirect(route('return-po.index'));
            return redirect(route('product'));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }
}
