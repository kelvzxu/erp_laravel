<?php

namespace App\Addons\Invoicing\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Addons\Contact\Models\res_customer;
use App\Addons\Invoicing\Models\return_invoice;
use App\Addons\Invoicing\Models\return_invoice_product;
use App\Addons\Invoicing\Models\Invoice;
use App\Addons\Inventory\Models\Product;
use App\Addons\Inventory\Models\stock_move;
use App\Addons\Inventory\Models\stock_valuation;
use App\Http\Controllers\controller as Controller;
use Brian2694\Toastr\Facades\Toastr;

class ReturnInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $return_inv = return_invoice::with('user')->orderBy('created_at','DESC')->paginate(25);
        return view('return-inv.index', compact('return_inv'));
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
            $invoice = invoice::where('invoice_no',$request->invoice_no)->first();
            $return = return_invoice::insertGetId([   
                    'return_no'=>$return_no,
                    'invoice_no'=>$request->invoice_no,
                    'delivery_no'=>$request->delivery_no,
                    'user_id'=>Auth::id(),
                    'client'=>$invoice->client,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
            foreach($products as $e => $data){
                $return_detail = return_invoice_product::create([
                        'return_invoice_id'=>$return,
                        'name'=>$data,
                        'price'=>$request->price[$e],
                        'qty'=>$request->buy_qty[$e],
                        'return_qty'=>$request->return_qty[$e],
                        'total'=>$request->price[$e] * $request->return_qty[$e],
                ]);
                echo $total=$request->price[$e] * $request->return_qty[$e];
                $product = product::find($data);
                $oldstock = $product->stock;
                $newstock = $oldstock + $request->return_qty[$e];
            
                product::where('id',$data)->update([
                        'stock' => $newstock,
                    ]);

                $stock_move_id= stock_move::with('valuation')->where([['reference',$request->delivery_no],['product_id',$data],['type','Invoice']])->first();
                $cost= $stock_move_id->valuation->unit_cost * -1;
                $stock_move = stock_move::insertGetId([
                    'product_id'=>$data,
                    'company_id'=>1,
                    'quantity'=>$request->return_qty[$e],
                    'location_id'=>$invoice->id, 
                    'location_name'=>$invoice->invoice_no,
                    'location_destination'=>$product->location,
                    'location_destination_name'=>"Company Warehouse",
                    'partner_id'=>$invoice->client,
                    'type'=>'Retur Invoice',
                    'reference'=>$return_no,
                    'state'=>"Done",
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
            $grandTotal = return_invoice_product:: where('return_invoice_id',$return)->sum('total');
            $partner = res_customer::findOrFail($request->client);
            $oldbalance = $partner->credit;
            $new_balance = $grandTotal + $oldbalance; 
            $partner->update([
                'credit' => $new_balance,
            ]);
            Toastr::success('Return inv:'.$request->invoice_no.' with delivery_no '.$request->delivery_no.' Success','Success');
            return redirect(route('return-invoice.index'));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }
    public function view($id)
    {
        $data = return_invoice::with('products','customer', 'products.product')->findorFail($id);
        // dump($invoice);
        return view('return-inv.show', compact('data'));
    }
    public function edit($id)
    {
        $data = return_invoice::with('products','customer', 'products.product')->findorFail($id);
        // dump($invoice);
        return view('return-inv.edit', compact('data'));
    }
    public function update (Request $request)
    {
        try{
            $return_inv = return_invoice::with('products')->findOrFail($request->id);
            $oldgrandTotal = return_invoice_product:: where('return_invoice_id',$request->id)->sum('total');
            $invoice = invoice::where('invoice_no',$return_inv->invoice_no)->first();
            $products= $request->line;
            foreach($products as $e => $data){
                $line = return_invoice_product::where([['id',$data],['name',$request->product[$e]]])->first();
                $line->update([
                    'return_qty'=>$line->return_qty + $request->return_qty[$e],
                    'total'=>$line->price * ($line->return_qty + $request->return_qty[$e]),
                ]);
                $product = product::find($request->product[$e]);
                $oldstock = $product->stock;
                $newstock = $oldstock + $request->return_qty[$e];
            
                product::where('id',$request->product[$e])->update([
                    'stock' => $newstock,
                ]);
    
                $stock_move_id= stock_move::with('valuation')->where([['reference',$return_inv->delivery_no],['product_id',$request->product[$e]],['type','Invoice']])->first();
                $cost= $stock_move_id->valuation->unit_cost * -1;
                $stock_move = stock_move::insertGetId([
                    'product_id'=>$request->product[$e],
                    'quantity'=>$request->return_qty[$e],
                    'location_id'=>$invoice->id, 
                    'location_destination'=>$product->location,
                    'partner_id'=>$invoice->client,
                    'type'=>'Retur Invoice',
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
            $grandTotal = return_invoice_product:: where('return_invoice_id',$request->id)->sum('total');
            $partner = res_customer::findOrFail($return_inv->client);
            $oldbalance = $partner->credit;
            $new_balance = ($grandTotal - $oldgrandTotal) + $oldbalance; 
            $partner->update([
                'credit' => $new_balance,
            ]);
            Toastr::success('Return inv:'.$return_inv->return_no.' with delivery_no '.$return_inv->delivery_no.' updated successfully','Success');
            return redirect(route('return-invoice.index'));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }
}
