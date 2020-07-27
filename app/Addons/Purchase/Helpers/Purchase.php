<?php
namespace App\Addons\Purchase\Helpers;

use Artisan;
use App\Addons\Purchase\Models\purchases_order;
use App\Addons\Purchase\Models\purchases_order_products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Purchase {
    public static function installed(){
        try{
            Artisan::call('migrate', array('--path' => 'app/Addons/Purchase/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            echo $e;
        }
    }

    public static function uninstalled(){
        try{
            Artisan::call('migrate:rollback', array('--path' => 'app/Addons/Purchase/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            return false;
        }
    }

    public static function purchase() {
        $purchase=purchases_order::with('partner','sales')->orderBy('order_no', 'ASC')->paginate(30);
        return $purchase;
    }
    public static function getPurchase($id) {
        $purchase=purchases_order::findOrFail($id);
        return $purchase;
    }
    public static function getPurchaseLine($id){
        $purchase = purchases_order_products::where('purchases_order_id','=',$id)->get();
        return $purchase;
    }
}