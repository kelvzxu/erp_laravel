<?php
namespace App\Addons\Sales\Helpers;

use Artisan;
use App\Addons\Sales\Models\sales_order;
use App\Addons\Sales\Models\sales_order_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sales {
    public static function installed(){
        try{
            Artisan::call('migrate', array('--path' => 'app/Addons/Sales/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            echo $e;
        }
    }

    public static function uninstalled(){
        try{
            Artisan::call('migrate:rollback', array('--path' => 'app/Addons/Sales/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            return false;
        }
    }

    public static function sales() {
        $sales=sales_order::with('partner','sales_person')->orderBy('order_no', 'ASC')->paginate(30);
        return $sales;
    }
    public static function getSales($id) {
        $sales=sales_order::findOrFail($id);
        return $sales;
    }
    public static function getSalesLine($id){
        $sales_line = sales_order_product::where('sales_order_id','=',$id)->get();
        return $sales_line;
    }
}