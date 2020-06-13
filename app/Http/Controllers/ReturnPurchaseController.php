<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Merchandises\Purchase;
use App\Models\Partner\res_partner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\Merchandises\return_purchase;
use App\Models\Merchandises\return_purchase_product;
use App\Models\Product\stock_move;
use App\Models\Product\stock_valuation;
use App\access_right;
use App\User;

class ReturnPurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $return_po = return_purchase::with('user')->orderBy('created_at','DESC')->paginate(25);
        return view('return-po.index', compact('access','group','return_po'));
    }

    public function store(Request $request)
    {
        try{
            $year=date("Y");
            $prefixcode = "ReBILL-$year-";
            $count = return_purchase::all()->count();
            if ($count==0){
                $return_no= "$prefixcode"."000001";
            }else {
                $latestInv = return_purchase::orderBy('id','DESC')->first();
                $return_no = $prefixcode.str_pad($latestInv->id + 1, 6, "0", STR_PAD_LEFT);
            }
            $products= $request->product;
            $purchase = Purchase::where('purchase_no',$request->purchase_no)->first();
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

                $stock_move_id= stock_move::with('valuation')->where([['reference',$request->receipt_no],['product_id',$data],['type','Purchase']])->first();
                $cost= $stock_move_id->valuation->unit_cost * -1;
                $stock_move = stock_move::insertGetId([
                    'product_id'=>$data,
                    'quantity'=>$request->return_qty[$e],
                    'location_id'=>$product->location,
                    'location_destination'=>$purchase->id,
                    'partner_id'=>$purchase->client,
                    'type'=>'Retur Purchase',
                    'reference'=>$request->receipt_no,
                    'create_uid'=>Auth::id(),
                    'created_at'=>date('Y-m-d H:i:s'),
                ]);
                
                stock_valuation::insert([
                    'product_id'=>$data,
                    'quantity'=>$request->return_qty[$e],
                    'unit_cost'=>$cost,
                    'value'=>$request->return_qty[$e]*$cost,
                    'description'=>" $return_no - $product->name",
                    'stock_move_id'=>$stock_move,
                    'create_uid'=>Auth::id(),
                    'created_at'=>date('Y-m-d H:i:s'),
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
