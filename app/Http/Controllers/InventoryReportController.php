<?php

namespace App\Http\Controllers;

use App\access_right;
use App\User;
use App\Models\Product\Product;
use App\Models\Product\stock_valuation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

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

    public function move()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $data= product::has('move')->orderBy('name','asc')->paginate(40);
        return view ('products.report.stock_move',compact('data','access','group'));
    }

    public function print_valuation()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $data= product::has('valuation')->orderBy('name','asc')->paginate(40);
        $valuation = stock_valuation::get();
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')
                ->loadview('reports.product.inventory_valuation',compact('data','access','group','valuation'));
        return $pdf->download();
    }

    public function print_move()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $data= product::has('move')->orderBy('name','asc')->paginate(40);
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')
                ->loadview('reports.product.stock_move',compact('data','access','group'));
        return $pdf->download();
    }
}
