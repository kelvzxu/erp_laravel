<?php

namespace App\Http\Controllers;

use App\access_right;
use App\User;
use App\Models\Product\Product;
use App\Models\Product\stock_valuation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryReportController extends Controller
{
    public function valuation()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $data= product::has('valuation')->orderBy('name','asc')->paginate(40);
        $valuation = stock_valuation::get();
        return view ('products.report.stock_valuation',compact('data','access','group','valuation'));
    }
}
