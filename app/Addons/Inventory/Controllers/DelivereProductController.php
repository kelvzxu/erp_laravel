<?php

namespace App\Addons\Inventory\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use App\Addons\Inventory\Models\delivere_product;
use App\Addons\Inventory\Models\stock_move;
use App\Addons\Inventory\Models\stock_valuation;
use App\Http\Controllers\controller as Controller;
use App\Models\Sales\Invoice;
use App\Models\Sales\return_invoice;
use Illuminate\Http\Request;
use Encrypt;
use Inventory;
use Invoicing;

class DelivereProductController extends Controller
{
    public function calculate_code()
    {
        $year=date("Y");
        $month=date("m");
        $prefixcode = "WH/OUT/$year/$month/";
        $count = delivere_product::where('delivery_no','like',"%".$prefixcode."%")->count();
        if ($count==0){
            return "$prefixcode"."000001";
        }else {
            return $prefixcode.str_pad($count + 1, 6, "0", STR_PAD_LEFT);
        }
    }

    public function index()
    {
        $delivery = delivere_product::orderBy('created_at','DESC')->paginate(25);
        return view('delivery.index', compact('delivery'));
    }

    public function store($id)
    {
        try {
            $delivery_no = $this->calculate_code();
            $invoice = Invoicing::getInvoice($id);
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
                $product = Inventory::getProduct($data->name);
                stock_move::insert([
                    'product_id'=>$data->name,
                    'quantity'=>$data->qty,
                    'company_id'=>1,
                    'location_id'=>$product->location,
                    'location_name'=>"Company Warehouse",
                    'location_destination'=>$id,
                    'location_destination_name'=>$invoice->invoice_no,
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
            return redirect(route('Delivere.show',Encrypt::Encryption($invoice->invoice_no)));
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
        $id=Encrypt::Decryption($id);
        $delivery = Inventory::getDeliveryByInvoice($id);
        $return_inv= return_invoice::where('invoice_no',$id)->count();
        return view('delivery.show', compact('delivery','return_inv'));
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
            $invoice = Invoicing::getInvoiceByInvoiceNo($id);
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
                stock_move::where([['location_destination',$invoice->id],['type','Invoice'],['product_id',$product_id]])->update([
                    'state'=>"Done"
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
        $invoice = Invoicing::getInvoiceByInvoiceNo($id);
        $delivery = delivere_product::where('invoice_no', $id)->first();
        // dump($invoice);
        return view('return-inv.return', compact('invoice','delivery'));
    }
}
