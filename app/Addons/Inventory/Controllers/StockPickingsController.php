<?php
namespace App\Addons\Inventory\Controllers;

use Illuminate\Http\Request;
use App\Addons\Inventory\Models\stock_picking;
use App\Addons\Inventory\Models\stock_picking_line;
use App\Http\Controllers\controller as Controller;
use Inventory;

class StockPickingsController extends Controller
{
    public function getStockPicking($id)
    {
        try{
            $request = stock_picking::findOrFail($id);
            if ($request->picking_type == 'Delivery Orders'){
                $response = stock_picking::with('picking_line','picking_line.product','responsible','company','sales_order','sales_order.partner','sales_warehouse')->findOrFail ($id);
            }

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

    public function calculate_code($code){
        $year=date("Y");
        $month=date("m");
        $prefixcode = "$code/OUT/$year/$month/";
        $count = stock_picking::where('name','like',"%".$prefixcode."%")->count();
        if ($count==0){
            return "$prefixcode"."000001";
        }else {
            return $prefixcode.str_pad($count + 1, 6, "0", STR_PAD_LEFT);
        }
    }

    public function store(Request $request){
        try {
            $code = Inventory::checkWarehouseCode($request->product_warehouse_id);
            $name = $this->calculate_code($code);

            if ($request->state == 'sale'){
                $location = $request->product_warehouse_id;
                $destination = $request->id;
                $type = 'Delivery Orders';
                $partner = $request->customer;
                $user = $request->sales;
            }else if ($request->state == 'purchase'){
                $destination = $request->product_warehouse_id;
                $location = $request->id;
                $type = 'Receipts';
            }

            $products = collect($request->products)->transform(function($product) {
                $product['id'] = mt_rand();
                $product['product_id'] = $product['name'];
                $product['done_qty'] = 0;
                return new stock_picking_line($product);
            });

            $preparatition = $request->except('products');
            $data = [
                'name' =>$name,
                'origin'=>$preparatition['order_no'],
                'move_type'=>$preparatition['shipping_policy'],
                'state'=>'draft',
                'schedule_date'=>date('Y-m-d H:i:s'),
                'location_id'=>$location,
                'destination_id'=>$destination,
                'picking_type'=>$type,
                'partner_id'=>$partner,
                'company_id'=>$preparatition['company_id'],
                'is_locked'=>false,
                'order_id'=>$preparatition['id'],
                'create_uid' =>$user,
            ];

            $stock_picking = stock_picking::create($data);

            $stock_picking->picking_line()->saveMany($products);

            return response()->json([
                'status' => 'success',
                'message' => $stock_picking->id,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }
}