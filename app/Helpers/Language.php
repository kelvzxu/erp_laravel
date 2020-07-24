<?php
namespace App\Helpers;

use App\Models\Data\res_lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Language {
    public static function lang() {
        $lang = res_lang::orderBy('lang_name', 'ASC')->where('active',true)->get();
        return $lang;
    }
}