<?php
namespace App\Helpers;

use App\access_right;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Access {
    public static function access() {
        $access=access_right::where('user_id',Auth::id())->first();
        return $access;
    }
}