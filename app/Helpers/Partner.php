<?php
namespace App\Helpers;

use App\Models\Customer\res_customer;
use App\Models\Data\res_partner_industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class partner {
    public static function industry() {
        $industry= res_partner_industry::orderBy('industry_name', 'ASC')->get();
        return $industry;
    }
    public static function customer() {
        $customer= res_customer::orderBy('name', 'ASC')->get();
        return $customer;
    }
}