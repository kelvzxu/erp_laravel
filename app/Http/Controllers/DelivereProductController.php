<?php

namespace App\Http\Controllers;

use App\Models\Sales\delivere_product;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Product\Product;
use App\Models\Sales\Invoice;
use Illuminate\Http\Request;

class DelivereProductController extends Controller
{
    public function index()
    {
        $delivery = delivere_product::orderBy('created_at','DESC')->paginate(25);
        return view('delivery.index', compact('delivery'));
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
        $delivery = delivere_product::with('inv')->where('invoice_no',$id)->first();
        return view('delivery.show', compact('delivery'));
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
            $invoice = invoice::where('invoice_no',$delivery->invoice_no)->update([
                'deliver_validate'=> True,
            ]);
            foreach ($delivery->inv->products as $data){
                $qty = $data->qty;
                $product_id = $data->name;

                $product = Product::find($product_id);
                $oldstock = $product->stock;
                $newstock = $oldstock - $qty;

                Product::where('id',$product_id)->update([
                    'stock' => $newstock,
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
        $invoice = Invoice::where('invoice_no', $id)->with('products','customer', 'products.product')->first();
        $delivery = delivere_product::where('invoice_no', $id)->first();
        // dump($invoice);
        return view('return-inv.return', compact('invoice','delivery'));
    }
}
