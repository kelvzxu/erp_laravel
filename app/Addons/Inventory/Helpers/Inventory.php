<?php
namespace App\Addons\Inventory\Helpers;

use Artisan;
use App\Addons\Inventory\Models\category;
use App\Addons\Inventory\Models\product;
use App\Addons\Inventory\Models\delivere_product;
use App\Addons\Inventory\Models\receive_product;
use App\Addons\Inventory\Models\product_warehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;

class Inventory {
    public static function installed(){
        Artisan::call('migrate', array('--path' => 'app/Addons/Inventory/Migrations', '--force' => true));
        $removal = [
            ['name'=>'First In First Out (FIFO)','method'=>'FIFO','create_uid'=>1,'created_at' =>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')],
            ['name'=>'Last In First Out (LIFO)','method'=>'LIFO','create_uid'=>1,'created_at' =>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')],
        ];
        $category = [
            ['name'=>'All','complete_name'=>'All','removal_strategy_id'=>1,'costing_method'=>'standard','create_uid'=>1,'created_at' =>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')]
        ];
        $warehouse = [
            ['name'=>'My Company Warehouse', 'code'=>'WH','company_id'=>1,'created_at' =>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')],
        ];
        DB::table('product_removal')->insert($removal);
        DB::table('product_categories')->insert($category);
        DB::table('product_warehouses')->insert($warehouse);
    }

    public static function uninstalled(){
        try{
            Artisan::call('migrate:rollback', array('--path' => 'app/Addons/Inventory/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            return false;
        }
    }

    public static function categories() {
        $categories = category::orderBy('name', 'ASC')->get();
        return $categories;
    }

    public static function products() {
        $product = product::with('stock','uom','category')->orderBy('name', 'ASC')->get();
        return $product;
    }

    public static function can_be_sold() {
        $product = product::with('stock','uom','category')->orderBy('name', 'asc')->where('can_be_sold','1')->get();
        return $product;
    }

    public static function can_be_purchase() {
        $product = product::orderBy('name', 'asc')->where('can_be_purchase','1')->get();
        return $product;
    }

    public static function getProduct($id){
        $product = product::with('category')->findOrFail($id);
        return $product;
    }

    public static function getDeliveryByInvoice($id){
        $delivery = delivere_product::with('inv')->where('invoice_no',$id)->first();
        return $delivery;
    }

    public static function getReceiveByBill($id){
        $receive = receive_product::with('po')->where('purchase_no',$id)->first();
        return $receive;
    }

    public static function checkWarehouseCode($id){
        $warehouse = product_warehouse::findOrFail($id);
        return $warehouse->code;
    }
}