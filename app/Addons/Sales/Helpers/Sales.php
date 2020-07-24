<?php
namespace App\Addons\Sales\Helpers;

use App\Addons\Sales\Models\sales_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sales {
    public static function sales() {
        $sales=sales_order::with('partner','sales_person')->orderBy('order_no', 'ASC')->paginate(30);
        return $sales;
    }
    public static function get_sales($id) {
        $sales=sales_order::findOrFail($id);
        return $sales;
    }
}