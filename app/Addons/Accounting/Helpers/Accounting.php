<?php
namespace App\Addons\Accounting\Helpers;

use Artisan;
use App\Addons\Accounting\Models\account_account;
use App\Addons\Accounting\Models\account_journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Accounting {
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

    public static function account_account() {
        $account = account_account::orderBy('code','asc')->get();
        return $account;
    }

    public static function account_journal() {
        $journal = account_journal::orderBy('code','asc')->get();
        return $journal;
    }
}