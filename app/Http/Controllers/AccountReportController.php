<?php

namespace App\Http\Controllers;

use App\access_right;
use App\User;
use App\Models\Accounting\account_account;
use App\Models\Accounting\account_move_line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
