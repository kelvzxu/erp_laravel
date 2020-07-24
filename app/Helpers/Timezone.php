<?php
namespace App\Helpers;

use App\Models\Data\timezone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnterpriseTimezone {
    public static function timezone() {
        $tz = timezone::orderBy('timezone', 'ASC')->get();
        return $tz;
    }
}