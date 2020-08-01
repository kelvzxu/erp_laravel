<?php

namespace App\Addons\Uom\Controllers;

use App\Addons\Uom\Models\uom_uom;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class UomController extends Controller
{
   public function fetchUom(){
        try {
            $response = uom_uom::with('category','type')
                    ->orderBy('created_at', 'desc')
                    ->get();
            return response()->json([
                'status' => 'success',
                'data' => $response
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'data' => []
            ]);
        }
   }
}
