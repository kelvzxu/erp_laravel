<?php

namespace App\Addons\Accounting\Controllers;

use App\Addons\Accounting\Models\account_account;
use App\Addons\Accounting\Models\account_move_line;
use App\Addons\Contact\Models\res_customer;
use App\Addons\Contact\Models\res_partner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\controller as Controller;
use PDF;

class AccountReportController extends Controller
{
    public function Generalledger()
    {
        $data= account_account::has('move_lines')->orderBy('code','asc')->paginate(40);
        $totaldebit= account_move_line::sum('debit');
        $totalcredit= account_move_line::sum('credit');
        return view ('accounting.report.general_ledger',compact('data','totaldebit','totalcredit'));
    }
    public function partnerledger(Request $request)
    {
        if ($request->partner_type == "vendor"){
            $type=$request->partner_type;
            $data= res_partner::whereHas('move_lines')->orderBy('partner_name','asc')->where('credit','!=','0')->orWhere('debit','!=','0')->paginate(40);
        } else if ($request->partner_type == "customer"){
            $type=$request->partner_type;
            $data= res_customer::whereHas('move_lines')->orderBy('name','asc')->where('credit','!=','0')->orWhere('debit','!=','0')->paginate(40);
        }else {
            Toastr::error('Partner Type '.$request->partner_type.' Not Found','Something Wrong');
            return redirect()->back();
        }
        foreach($data as $e){
            // dump($e->move_lines);
        }
        return view ('accounting.report.partner_ledger',compact('data','type'));
    }
    public function print_gl()
    {
        $data= account_account::has('move_lines')->orderBy('code','asc')->paginate(40);
        $totaldebit= account_move_line::sum('debit');
        $totalcredit= account_move_line::sum('credit');
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')
                ->loadview('reports.accounting.general_ledger', compact('data','totaldebit','totalcredit'));
        return $pdf->download();
    }
    public function print_pl($type)
    {
        if ($type == "vendor"){
            $data= res_partner::whereHas('move_lines')->orderBy('partner_name','asc')->where('credit','!=','0')->orWhere('debit','!=','0')->paginate(40);
        } else if ($type == "customer"){
            $data= res_customer::whereHas('move_lines')->orderBy('name','asc')->where('credit','!=','0')->orWhere('debit','!=','0')->paginate(40);
        }else {
            Toastr::error('Partner Type '.$type.' Not Found','Something Wrong');
            return redirect()->back();
        }
        foreach($data as $e){
            // dump($e->move_lines);
        }
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')
                ->loadview('reports.accounting.partner_ledger',compact('data','type'));
        return $pdf->download();
    }
}
