<?php

namespace App\Addons\Invoicing\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Addons\Contact\Models\res_partner;
use App\Addons\Invoicing\Models\Bill;
use App\Addons\Invoicing\Models\return_purchase;
use App\Addons\Invoicing\Models\return_purchase_product;
use App\Addons\Inventory\Models\Product;
use App\Addons\Inventory\Models\stock_move;
use App\Addons\Inventory\Models\stock_valuation;
use App\Http\Controllers\controller as Controller;
use Brian2694\Toastr\Facades\Toastr;

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
            $prefixcode = "ReBILL-$year-";
            $count = return_purchase::all()->count();
            if ($count==0){
                $return_no= "$prefixcode"."000001";
            }else {
                $latestInv = return_purchase::orderBy('id','DESC')->first();
                $return_no = $prefixcode.str_pad($latestInv->id + 1, 6, "0", STR_PAD_LEFT);
            }
            $products= $request->product;
            $purchase = Bill::where('purchase_no',$request->purchase_no)->first();
            $return = return_purchase::insertGetId([   
                'return_no'=>$return_no,
                'purchase_no'=>$request->purchase_no,
                'receipt_no'=>$request->receipt_no,
                'user_id'=>Auth::id(),
                'client'=>$purchase->client,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            foreach($products as $e => $data){
                echo $request->price[$e];
                $return_detail = return_purchase_product::create([
                    'return_purchase_id'=>$return,
                    'name'=>$data,
                    'price'=>$request->price[$e],
                    'qty'=>$request->buy_qty[$e],
                    'return_qty'=>$request->return_qty[$e],
                    'total'=>$request->price[$e] * $request->return_qty[$e],
                ]);
                echo $total=$request->price[$e] * $request->return_qty[$e];
                $product = product::find($data);
                $oldstock = $product->stock;
                $newstock = $oldstock - $request->return_qty[$e];
    
                product::where('id',$data)->update([
                    'stock' => $newstock,
                ]);

                $stock_move_id= stock_move::with('valuation')->where([['reference',$request->receipt_no],['product_id',$data],['type','Purchase']])->first();
                $cost= $stock_move_id->valuation->unit_cost * -1;
                $stock_move = stock_move::insertGetId([
                    'product_id'=>$data,
                    'quantity'=>$request->return_qty[$e],
                    'company_id'=>1,
                    'location_id'=>$product->location,
                    'location_name'=>"Company Warehouse",
                    'location_destination'=>$purchase->id,
                    'location_destination_name'=>$purchase->purchase_no,
                    'partner_id'=>$purchase->client,
                    'type'=>'Retur Purchase',
                    'state'=>"Done",
                    'reference'=>$return_no,
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
            $grandTotal = return_purchase_product:: where('return_purchase_id',$return)->sum('total');
            $partner = res_partner::findOrFail($request->client);
            $oldbalance = $partner->credit;
            $new_balance = $grandTotal + $oldbalance; 
            $partner->update([
                'credit' => $new_balance,
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

    public function view($id)
    {
        $data = return_purchase::with('products','partner', 'products.product')->findorFail($id);
        return view('return-po.show', compact('data'));
    }

    public function edit($id)
    {
        $data = return_purchase::with('products','partner', 'products.product')->findorFail($id);
        return view('return-po.edit', compact('data'));
    }

    public function update (Request $request)
    {
        // try{
            $return_inv = return_purchase::with('products')->findOrFail($request->id);
            $oldgrandTotal = return_purchase_product:: where('return_purchase_id',$request->id)->sum('total');
            $invoice = Bill::where('purchase_no',$return_inv->purchase_no)->first();
            $products= $request->line;
            foreach($products as $e => $data){
                $line = return_purchase_product::where([['id',$data],['name',$request->product[$e]]])->first();
                $line->update([
                    'return_qty'=>$line->return_qty + $request->return_qty[$e],
                    'total'=>$line->price * ($line->return_qty + $request->return_qty[$e]),
                ]);
                $product = product::find($request->product[$e]);
                $oldstock = $product->stock;
                $newstock = $oldstock - $request->return_qty[$e];
            
                product::where('id',$request->product[$e])->update([
                    'stock' => $newstock,
                ]);
    
                $stock_move_id= stock_move::with('valuation')->where([['reference',$return_inv->receipt_no],['product_id',$request->product[$e]],['type','Purchase']])->first();
                $cost= $stock_move_id->valuation->unit_cost * -1;
                $stock_move = stock_move::insertGetId([
                    'product_id'=>$request->product[$e],
                    'quantity'=>$request->return_qty[$e],
                    'location_id'=>$product->location,
                    'location_destination'=>$invoice->id,
                    'partner_id'=>$invoice->client,
                    'type'=>'Retur Purchase',
                    'reference'=>$return_inv->return_no,
                    'state'=>"Done",
                    'create_uid'=>Auth::id(),
                    'created_at'=>date('Y-m-d H:i:s'),
                ]);
    
                stock_valuation::insert([
                    'product_id'=>$request->product[$e],
                    'quantity'=>$request->return_qty[$e],
                    'unit_cost'=>$cost,
                    'value'=>$request->return_qty[$e]*$cost,
                    'description'=>" $return_inv->return_no - $product->name",
                    'stock_move_id'=>$stock_move,
                    'create_uid'=>Auth::id(),
                    'created_at'=>date('Y-m-d H:i:s'),
                ]);
            }
            $grandTotal = return_purchase_product:: where('return_purchase_id',$request->id)->sum('total');
            $partner = res_partner::findOrFail($return_inv->client);
            $oldbalance = $partner->credit;
            $new_balance = ($grandTotal - $oldgrandTotal) + $oldbalance; 
            $partner->update([
                'credit' => $new_balance,
            ]);
        //     Toastr::success('Return inv:'.$return_inv->return_no.' with delivery_no '.$return_inv->delivery_no.' updated successfully','Success');
        //     return redirect(route('return-invoice.index'));
        // }catch (\Exception $e) {
        //     Toastr::error($e->getMessage(),'Something Wrong');
        //     // Toastr::error('Check In Error!','Something Wrong');
        //     return redirect()->back();
        // }
    }
}
