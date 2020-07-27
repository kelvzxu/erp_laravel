<?php

namespace App\Addons\Inventory\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Inventory\Models\Product;
use App\Addons\Inventory\Models\stock_valuation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use PDF;

class InventoryReportController extends Controller
{
    public function valuation()
    {
        $data= product::has('valuation')->orderBy('name','asc')->paginate(40);
        $valuation = stock_valuation::get();
        return view ('products.report.stock_valuation',compact('data','valuation'));
    }

    public function move()
    {
        $data= product::has('move')->orderBy('name','asc')->paginate(40);
        return view ('products.report.stock_move',compact('data'));
    }

    public function print_valuation()
    {
        $data= product::has('valuation')->orderBy('name','asc')->paginate(40);
        $valuation = stock_valuation::get();
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')
                ->loadview('reports.product.inventory_valuation',compact('data','valuation'));
        return $pdf->download();
    }

    public function print_move()
    {
        $data= product::has('move')->orderBy('name','asc')->paginate(40);
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')
                ->loadview('reports.product.stock_move',compact('data'));
        return $pdf->download();
    }
}
