<?php

namespace App\Addons\Inventory\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Inventory\Models\product;
use App\Addons\Inventory\Models\product_quant;
use App\Addons\Inventory\Models\product_warehouse;
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
}
