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
    
                product_quant::create($data);
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
}
