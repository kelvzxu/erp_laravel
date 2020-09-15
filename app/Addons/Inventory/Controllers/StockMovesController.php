<?php

namespace App\Addons\Inventory\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Inventory\Models\stock_move;
use App\Addons\Inventory\Models\product_warehouse;
use Illuminate\Http\Request;

class StockMovesController extends Controller
{
    public function store(Request $request, $products)
    {
        $pickingtype = $request->picking_type;
        if ($pickingtype == "Delivery Orders"){
            $location =  product_warehouse::findorFail($request->location_id);
            $location = $location->name;
            $destination = $request->origin;
        }
        if ($pickingtype == "Receipts"){
            $location =  $request->origin;
            $destination =  product_warehouse::findorFail($request->destination_id);
            $destination = $destination->name;
        }
        $data = [
            'company_id'=>$request->company_id,
            'product_id'=>$products['product_id'],
            'quantity'=>$products['done_qty'],
            'product_uom'=>$products['product_uom'],
            'location_id'=>$request->location_id,
            'location_destination'=>$request->destination_id,
            'location_name'=>$location,
            'location_destination_name'=>$destination,
            'partner_id'=>$request->partner_id,
            'state'=>'done',
            'type'=>$request->picking_type,
            'reference'=>$request->name,
            'create_uid'=>$request->create_uid,
        ];
        stock_move::create($data);
    }
}
