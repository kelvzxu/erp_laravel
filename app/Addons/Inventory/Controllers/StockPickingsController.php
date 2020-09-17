<?php
namespace App\Addons\Inventory\Controllers;

use Illuminate\Http\Request;
use App\Addons\Inventory\Models\stock_picking;
use App\Addons\Inventory\Models\stock_picking_line;
use App\Addons\Sales\Controllers\SalesOrdersController;
use App\Addons\Purchase\Controllers\PurchasesOrdersController;
use App\Http\Controllers\controller as Controller;
use Inventory;

class StockPickingsController extends Controller
{
    public function getStockPicking($id)
    {
        try{
            $request = stock_picking::findOrFail($id);
            if ($request->picking_type == 'Delivery Orders'){
                $response = stock_picking::with('picking_line','picking_line.product','responsible','company','sales_order','sales_order.partner','sales_order.products','sales_warehouse')->findOrFail ($id);
            }
            if ($request->picking_type == 'Receipts'){
                $response = stock_picking::with('picking_line','picking_line.product','responsible','company','purchases_order','purchases_order.partner','purchases_warehouse')->findOrFail ($id);
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

    public function fetchReceiptPicking($id)
    {
        try{
            $response = stock_picking::with('company','purchases_order','purchases_order.partner')->where('picking_type','Receipts')->where('destination_id',$id)->orderby('created_at','DESC')->get();
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

    public function fetchDeliverePicking()
    {
        try{
            $response = stock_picking::with('company','sales_order','sales_order.partner')->where('picking_type','Delivery Orders')->orderby('created_at','DESC')->get();
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

    public function todo(Request $request){
        try{
            $response = stock_picking::findOrFail($request->id)->update([
                'state' =>"Ready"
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Stock Picking $request->name Ready"
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function calculate_code($code,$uniq){
        $year=date("Y");
        $month=date("m");
        $prefixcode = "$code/$uniq/$year/$month/";
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
            
            if ($request->state == 'sale'){
                $name = $this->calculate_code($code,'OUT');
                $location = $request->product_warehouse_id;
                $destination = $request->id;
                $type = 'Delivery Orders';
                $partner = $request->customer;
                $user = $request->sales;
            }else if ($request->state == 'purchase'){
                $name = $this->calculate_code($code,'IN');
                $destination = $request->product_warehouse_id;
                $location = $request->id;
                $type = 'Receipts';
                $partner = $request->vendor;
                $user = $request->merchandise;
            }

            $products = collect($request->products)->transform(function($product) {
                $product['id'] = mt_rand();
                $product['product_id'] = $product['name'];
                $product['qty']=$product['product_uom_qty'];
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

    public function validate_picking(Request $request)
    {
        try{
            foreach ($request->picking_line as $products){
                stock_picking_line::find($products['id'])->update($products);
                $type = $products['product']['type'];
                if ($type == "product"){
                    app(ProductQuantController::class)->UpdateQuant($request,$products);
                }
                if ($products['done_qty'] > 0){
                    app(StockMovesController::class)->store($request,$products);
                    app(StockValuationController::class)->store($request,$products);
                }
            }
            if ($request->picking_type == "Delivery Orders"){
                app(SalesOrdersController::class)->updateDelivery($request);
            } else if ($request->picking_type == "Receipts"){
                app(PurchasesOrdersController::class)->updateReceipt($request);
            }
            stock_picking::findOrFail($request->id)->update([
                'state' =>"Done"
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "$request->name Validate Successfully",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }
}