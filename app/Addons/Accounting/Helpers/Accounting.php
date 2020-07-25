<?php
namespace App\Addons\Accounting\Helpers;

use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Partner {
    public static function installed(){
        try{
            Artisan::call('migrate', array('--path' => 'app/Addons/Accounting/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            echo $e;
        }
    }

    public static function uninstalled(){
        try{
            Artisan::call('migrate:rollback', array('--path' => 'app/Addons/Accounting/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            return false;
        }
    }
}