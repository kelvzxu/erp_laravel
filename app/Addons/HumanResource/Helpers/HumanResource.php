<?php
namespace App\Addons\HumanResource\Helpers;

use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HumanResource {
    public static function installed(){
        try{
            Artisan::call('migrate', array('--path' => 'app/Addons/HumanResource/Migrations', '--force' => true));
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

    
}