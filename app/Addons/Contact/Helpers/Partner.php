<?php
namespace App\Addons\Contact\Helpers;

use Artisan;
use App\Addons\Contact\Models\res_partner;
use App\Addons\Contact\Models\res_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Partner {
    public static function installed(){
        try{
            Artisan::call('migrate', array('--path' => 'app/Addons/Contact/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            echo $e;
        }
    }

    public static function uninstalled(){
        try{
            Artisan::call('migrate:rollback', array('--path' => 'app/Addons/Contact/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            return false;
        }
    }

    public static function vendor() {
        $vendor = res_partner::orderBy('partner_name', 'ASC');
        return $vendor ; 
    }

    public static function customer() {
        $customer = res_customer::orderBy('name', 'ASC');
        return $customer ;
    }

    public static function getVendor($id) {
        $vendor = res_partner::orderBy('name', 'ASC')->findOrFail($id);
        return $vendor ; 
    }

    public static function getCustomer($id) {
        $customer = res_customer::orderBy('name', 'ASC')->findOrFail($id);
        return $customer ;
    }
}