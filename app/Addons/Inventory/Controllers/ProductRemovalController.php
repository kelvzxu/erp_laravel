<?php

namespace App\Addons\Inventory\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Inventory\Models\product_removal;
use Illuminate\Http\Request;

class ProductRemovalController extends Controller
{
    public function FetchRemovalStrategy(){
        try {
            $response = product_removal::get();
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
