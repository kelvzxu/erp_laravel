<?php

namespace App\Addons\Inventory\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Inventory\Models\stock_move;
use App\Addons\Inventory\Models\stock_valuation;
use Illuminate\Http\Request;

class StockValuationController extends Controller
{
    public function store(Request $request,$products)
    {
        $stock_move = stock_move::where([['reference',$request->name],['type',$request->picking_type],['product_id',$products['product_id']]])->first();
        $product_name= $products['product']['name'];
        $quantity = $products['done_qty'];
        $unit_cost = $products['product']['cost'];
        $value = $products['done_qty'] * $products['product']['cost'];
        if ($request->picking_type == "Delivery Orders"){
            $quantity = "-$quantity";
            $unit_cost = "-$unit_cost";
            $value = "-$value";
        }
        $data= [
            'company_id'=>$request->company_id,
            'product_id'=>$products['product_id'],
            'quantity'=>$quantity,
            'unit_cost'=>$unit_cost,
            'value'=>$value,
            'description'=>"$request->name - $product_name",
            'stock_move_id'=>$stock_move->id,
            'create_uid'=>$request->create_uid,
        ];
        stock_valuation::create($data);
    }
}
