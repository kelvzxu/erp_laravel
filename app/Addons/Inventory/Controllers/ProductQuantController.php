<?php

namespace App\Addons\Inventory\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Inventory\Models\category;
use App\Addons\Inventory\Models\product;
use App\Addons\Inventory\Models\product_quant;
use App\Addons\Inventory\Models\product_warehouse;
use App\Addons\Purchase\Models\purchases_order_products;
use Illuminate\Http\Request;

class ProductQuantController extends Controller
{
    public function store(Request $request)
    {
        try{
            $warehouse = product_warehouse::get();
            $product = product::where('code',$request->code)->first();
            foreach($warehouse as $wh){
                $product_id = $product->id;
                $data = $request->all();
                $data['product_id'] = $product_id;
                $data['location_id'] = $wh->id;
                
                $product_quant = product_quant::where('product_id',$product_id)->where('location_id',$wh->id)->count();
                if ($product_quant == 0){
                    product_quant::create($data);
                }
            }
            return response()->json([
                'status' => 'success',
                'message' => "Product $request->name Created Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function store_product(Request $request){
        try{
            $products = product::where('type','product')->get();
            $wh = product_warehouse::where('code',strtoupper($request->code))->first();
            foreach ($products as $product){
                $product_id = $product->id;
                $data = $request->all();
                $data['product_id'] = $product_id;
                $data['location_id'] = $wh->id;
    
                product_quant::create($data);
            }
            return response()->json([
                'status' => 'success',
                'message' => "Warehouse $request->name Updated Successfully"
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function UpdateQuant(Request $request, $products)
    {
        $category = category::findorFail($products['product']['category_id']);
        $costing = $category->costing_method;
        $pickingtype = $request->picking_type;
        if ($pickingtype == "Delivery Orders"){
            $location = $request->location_id;
        }
        if ($pickingtype == "Receipts"){
            $location = $request->destination_id;
        }
        $product = product_quant::where('product_id',$products['product_id'])->where('location_id',$location)->first();
        $quantity = $product->quantity;
        if ($pickingtype == "Delivery Orders"){
            $product->update([
                'quantity' => $quantity - $products['done_qty'],
            ]);
        }
        if ($pickingtype == "Receipts"){
            $newstock = $quantity + $products['done_qty'];
            if ($costing == 'average')
            {
                $order = purchases_order_products::where('name',$products['product_id'])
                                                    ->where('purchases_order_id',$request->order_id)
                                                    ->where('qty',$products['qty'])
                                                    ->first();
                $oldstock = $product->quantity;
                $new_valuation = $products['done_qty'] * $order->price;
                $old_valuation = $oldstock * $products['product']['cost'];
                $new_cost = ceil(($new_valuation + $old_valuation)/$newstock);
                product::findorFail($products['product_id'])->update([
                    'cost' => $new_cost,
                ]);
            }
            $product->update([
                'quantity' => $newstock,
            ]);
        }
    }
}
