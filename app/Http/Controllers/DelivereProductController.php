<?php

namespace App\Http\Controllers;

use App\access_right;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Product\Product;
use App\Models\Product\stock_move;
use App\Models\Product\stock_valuation;
use App\Models\Sales\Invoice;
use App\Models\Sales\delivere_product;
use App\Models\Sales\return_invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DelivereProductController extends Controller
{
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $delivery = delivere_product::orderBy('created_at','DESC')->paginate(25);
        return view('delivery.index', compact('access','group','delivery'));
    }

    public function store($id)
    {
        try {
            $year=date("Y");
            $prefixcode = "WH-OUT-$year-";
            $count = delivere_product::all()->count();
            if ($count==0){
                $delivery_no= "$prefixcode"."000001";
            }else {
                $latestInv = delivere_product::orderBy('id','DESC')->first();
                $delivery_no = $prefixcode.str_pad($latestInv->id + 1, 6, "0", STR_PAD_LEFT);
            }
            $invoice = invoice::findOrFail($id);
            delivere_product::insert([
                'delivery_no'=>$delivery_no,
                'invoice_no'=>$invoice->invoice_no,
                'delivery_date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);

            // insert  Stock Move
            $delivere_product = delivere_product::where('delivery_no',$delivery_no)->first();
            foreach ($delivere_product->inv->products as $data){
                $product = Product::find($data->name);
                stock_move::insert([
                    'product_id'=>$data->name,
                    'quantity'=>$data->qty,
                    'location_id'=>$product->location,
                    'location_destination'=>$id,
                    'partner_id'=>$invoice->client,
                    'type'=>'Invoice',
                    'reference'=>$delivery_no,
                    'create_uid'=>Auth::id(),
                    'created_at'=>date('Y-m-d H:i:s'),
                ]);
            }
            $invoice->update([
                'deliver'=> True,
            ]);
            return redirect(route('Delivere.show',$invoice->invoice_no));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\delivere_product  $delivere_product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $delivery = delivere_product::with('inv')->where('invoice_no',$id)->first();
        $return_inv= return_invoice::where('invoice_no',$id)->count();
        return view('delivery.show', compact('access','group','delivery','return_inv'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\delivere_product  $delivere_product
     * @return \Illuminate\Http\Response
     */
    public function validation($id)
    {
        try {
            $delivery = delivere_product::findOrFail($id);
            $delivery->update([
                'validate'=> True,
            ]);
            $invoice = invoice::where('invoice_no',$delivery->invoice_no)->first();
            $invoice->update([
                'deliver_validate'=> True,
            ]);
            foreach ($delivery->inv->products as $data){
                $qty = $data->qty;
                $product_id = $data->name;

                $product = Product::find($product_id);
                $oldstock = $product->stock;
                $newstock = $oldstock - $qty;
                $value = $data->qty*$product->cost;
                Product::where('id',$product_id)->update([
                    'stock' => $newstock,
                ]);

                // insert stock Valuation
                $stock_move_id = stock_move::where([['location_destination',$invoice->id],['type','Invoice'],['product_id',$product_id]])->first();
                stock_valuation::insert([
                    'product_id'=>$data->name,
                    'quantity'=>"-$data->qty",
                    'unit_cost'=>"-$product->cost",
                    'value'=>"-$value",
                    'description'=>" $delivery->delivery_no - $product->name",
                    'stock_move_id'=>$stock_move_id->id,
                    'create_uid'=>Auth::id(),
                    'created_at'=>date('Y-m-d H:i:s'),
                ]);
            }
            Toastr::success('Delivery Product with inv_no: '.$delivery->invoice_no.' Validation Successfully','Success');
            return redirect(route('product'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function return($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $invoice = Invoice::where('invoice_no', $id)->with('products','customer', 'products.product')->first();
        $delivery = delivere_product::where('invoice_no', $id)->first();
        // dump($invoice);
        return view('return-inv.return', compact('access','group','invoice','delivery'));
    }
}
