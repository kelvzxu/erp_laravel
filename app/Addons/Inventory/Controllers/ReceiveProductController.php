<?php

namespace App\Addons\Inventory\Controllers;

use App\Models\Merchandises\Purchase;
use App\Models\Merchandises\return_purchase;
use App\Addons\Inventory\Models\receive_product;
use App\Addons\Inventory\Models\stock_move;
use App\Addons\Inventory\Models\stock_valuation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Encrypt;
use Inventory;

class ReceiveProductController extends Controller
{
    public function calculate_code()
    {
        $year=date("Y");
        $month=date("m");
        $prefixcode = "WH/IN/$year/$month/";
        $count = receive_product::where('delivery_no','like',"%".$prefixcode."%")->count();
        if ($count==0){
            return "$prefixcode"."000001";
        }else {
            return $prefixcode.str_pad($count + 1, 6, "0", STR_PAD_LEFT);
        }
    }

    public function index()
    {
        $receipt = receive_product::orderBy('created_at','DESC')->paginate(25);
        return view('receipt.index', compact('receipt'));
    }

    public function return($id)
    {
        $purchase = purchase::where('purchase_no', $id)->with('products','vendor', 'products.product')->first();
        $receipt = receive_product::where('purchase_no', $id)->first();
        return view('return-po.return', compact('purchase','receipt'));
    }

    public function store($id)
    {
        try {
            $receipt_no = $this->calculate_code(); 
            $purchase = purchase::findOrFail($id);
            receive_product::insert([
                'receipt_no'=>$receipt_no,
                'purchase_no'=>$purchase->purchase_no, 
                'receipt_date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);

            // insert  Stock Move
            $receipt_product = receive_product::where('receipt_no',$receipt_no)->first();
            foreach ($receipt_product->po->products as $data){
                $product = Product::find($data->name);
                stock_move::insert([
                    'product_id'=>$data->name,
                    'quantity'=>$data->qty,
                    'location_id'=>$id,
                    'company_id'=>1, 
                    'location_name'=>$purchase->purchase_no,
                    'location_destination'=>$product->location,
                    'location_destination_name'=>"Company Warehouse",
                    'partner_id'=>$purchase->client,
                    'type'=>'Purchase',
                    'reference'=>$receipt_no,
                    'create_uid'=>Auth::id(),
                    'created_at'=>date('Y-m-d H:i:s'),
                ]);
            }
            $purchase->update([
                'receipt'=> True,
            ]);
            return redirect(route('receipt.show',Encrypt::Encryption($purchase->purchase_no)));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $id=Encrypt::Decryption($id);
        $receipt = Inventory::getReceiveByBill($id);
        $return_po= return_purchase::where('purchase_no',$id)->count();
        return view('receipt.show', compact('receipt','return_po'));
    }

    public function validation($id)
    {
        try {
            $receipt_product = receive_product::findOrFail($id);
            $receipt_product->update([
                'validate'=> True,
            ]);
            $purchase = purchase::where('purchase_no',$receipt_product->purchase_no)->first();
            $purchase->update([
                'receipt_validate'=> True,
            ]);
            foreach ($receipt_product->po->products as $data){
                $qty = $data->qty;
                $price = $data->price;
                $new_valuation = $qty * $price;
                $product_id = $data->name;
                
                
                $product = Product::find($product_id);
                $oldstock = $product->stock;
                $old_valuation = $oldstock * $product->cost;
                $newstock = $oldstock + $qty;
                $new_cost = ceil(($new_valuation + $old_valuation)/$newstock);
                
                Product::where('id',$product_id)->update([
                    'stock' => $newstock,
                    'cost' => $new_cost,
                    ]);

                // insert stock Valuation
                $stock_move_id = stock_move::where([['location_id',$purchase->id],['type','Purchase'],['product_id',$product_id]])->first();
                stock_valuation::insert([
                    'product_id'=>$data->name,
                    'quantity'=>$data->qty,
                    'unit_cost'=>$new_cost,
                    'value'=>$data->qty*$new_cost,
                    'description'=>" $receipt_product->receipt_no - $product->name",
                    'stock_move_id'=>$stock_move_id->id,
                    'create_uid'=>Auth::id(),
                    'created_at'=>date('Y-m-d H:i:s'),
                ]);
            }
            stock_move::where([['location_id',$purchase->id],['type','Purchase']])->update([
                'state'=>"Done"
            ]);
            Toastr::success('Receipt Product Validation Successfully','Success');
            return redirect(route('product'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }
}
