<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Sales\return_invoice;
use App\Models\Sales\return_invoice_product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ReturnInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
                // echo $request->product[$e];
                $return_detail = return_invoice_product::create([
                    'return_id'=>$return,
                    'name'=>$data,
                    'qty'=>$request->buy_qty[$e],
                    'return_qty'=>$request->return_qty[$e],
                ]);
                $product = Product::find($data);
                $oldstock = $product->stock;
                $newstock = $oldstock + $request->return_qty[$e];
    
                Product::where('id',$data)->update([
                    'stock' => $newstock,
                ]);
            }
            Toastr::success('Return inv:'.$request->invoice_no.' with delivery_no'.$request->delivery_no.' Success','Success');
            return redirect(route('product'));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }

    }
}
