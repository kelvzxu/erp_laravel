<?php
namespace App\Addons\Inventory\Helpers;

use Artisan;
use App\Addons\Inventory\Models\category;
use App\Addons\Inventory\Models\product;
use App\Addons\Inventory\Models\delivere_product;
use App\Addons\Inventory\Models\receive_product;
use Illuminate\Http\Request;

class Inventory {
    public static function installed(){
        try{
            Artisan::call('migrate', array('--path' => 'app/Addons/Inventory/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            echo $e;
        }
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
}