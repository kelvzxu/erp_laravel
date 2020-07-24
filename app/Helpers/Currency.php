<?php
namespace App\Helpers;

use App\Models\Currency\res_currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Currency {
    public static function currency() {
        $currency = res_currency::orderBy('currency_name', 'ASC')->where('active',true)->get();
        return $currency;
    }
}