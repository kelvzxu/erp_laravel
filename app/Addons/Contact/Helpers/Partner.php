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
        $vendor = res_partner::orderBy('partner_name', 'ASC')->get();
        return $vendor ; 
    }

    public static function customer() {
        $customer = res_customer::orderBy('name', 'ASC')->get();
        return $customer ;
    }

    public static function getVendor($id) {
        $vendor = res_partner::findOrFail($id);
        return $vendor ; 
    }

    public static function getCustomer($id) {
        $customer = res_customer::findOrFail($id);
        return $customer ;
    }

    public static function getCustomerDebt($id) {
        $customer = res_customer::orderBy('name', 'asc')->where('debit','>',0)->paginate(30);
        return $customer;
    }

    public static function getCustomerDebit() {
        
    }
}