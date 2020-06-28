<?php

namespace App\Http\Controllers;

use App\access_right;
use App\User;
use App\Models\Accounting\account_account;
use App\Models\Accounting\account_move_line;
use App\Models\Customer\res_customer;
use App\Models\Partner\res_partner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AccountReportController extends Controller
{
    public function Generalledger()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $data= account_account::has('move_lines')->orderBy('code','asc')->paginate(40);
        $totaldebit= account_move_line::sum('debit');
        $totalcredit= account_move_line::sum('credit');
        return view ('accounting.report.general_ledger',compact('data','access','group','totaldebit','totalcredit'));
    }
    public function partnerledger(Request $request)
    {
        if ($request->partner_type == "vendor"){
            $access=access_right::where('user_id',Auth::id())->first();
            $group=user::find(Auth::id());
            $type=$request->partner_type;
            $data= res_partner::whereHas('move_lines')->orderBy('partner_name','asc')->where('credit_limit','!=','0')->orWhere('debit_limit','!=','0')->paginate(40);
        } else if ($request->partner_type == "customer"){
            $access=access_right::where('user_id',Auth::id())->first();
            $group=user::find(Auth::id());
            $type=$request->partner_type;
            $data= res_customer::whereHas('move_lines')->orderBy('name','asc')->where('credit_limit','!=','0')->orWhere('debit_limit','!=','0')->paginate(40);
        }else {
            Toastr::error('Partner Type '.$request->partner_type.' Not Found','Something Wrong');
            return redirect()->back();
        }
        foreach($data as $e){
            // dump($e->move_lines);
        }
        return view ('accounting.report.partner_ledger',compact('data','access','group','type'));
    }
    public function print_gl()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $data= account_account::has('move_lines')->orderBy('code','asc')->paginate(40);
        $totaldebit= account_move_line::sum('debit');
        $totalcredit= account_move_line::sum('credit');
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')
                ->loadview('reports.accounting.general_ledger', compact('data','access','group','totaldebit','totalcredit'));
        return $pdf->download();
    }
    public function print_pl($type)
    {
        if ($type == "vendor"){
            $access=access_right::where('user_id',Auth::id())->first();
            $group=user::find(Auth::id());
            $data= res_partner::whereHas('move_lines')->orderBy('partner_name','asc')->where('credit_limit','!=','0')->orWhere('debit_limit','!=','0')->paginate(40);
        } else if ($type == "customer"){
            $access=access_right::where('user_id',Auth::id())->first();
            $group=user::find(Auth::id());
            $data= res_customer::whereHas('move_lines')->orderBy('name','asc')->where('credit_limit','!=','0')->orWhere('debit_limit','!=','0')->paginate(40);
        }else {
            Toastr::error('Partner Type '.$type.' Not Found','Something Wrong');
            return redirect()->back();
        }
        foreach($data as $e){
            // dump($e->move_lines);
        }
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')
                ->loadview('reports.accounting.partner_ledger',compact('data','access','group','type'));
        return $pdf->download();
    }
}
