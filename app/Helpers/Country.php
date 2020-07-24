<?php
namespace App\Helpers;

use App\Models\World_database\res_country;
use App\Models\World_database\res_country_state;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Country {
    public static function country() {
        $country=res_country::orderBy('country_name', 'ASC')->get();
        return $country;
    }
    public static function state() {
        $state=res_country_state::orderBy('state_name', 'ASC')->get();
        return $state;
    }
}