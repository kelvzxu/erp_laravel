<?php

namespace App\Addons\Inventory\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Inventory\Models\product_warehouse;
use Illuminate\Http\Request;

class ProductWarehouseController extends Controller
{
    public function FetchWarehouse(){
        try {
            $response = product_warehouse::with('company')->get();
            return response()->json([
                'status' => 'success',
                'result' => $response
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'result' => []
            ]);
        }
    }
    public function getWarehouse($request){
        try {
            $response = product_warehouse::findorFail($request);
            return response()->json([
                'status' => 'success',
                'result' => $response
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'result' => []
            ]);
        }
    }

}
