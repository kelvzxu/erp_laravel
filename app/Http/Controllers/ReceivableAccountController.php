<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer\customer_dept;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;
use PDF;

class ReceivableAccountController extends Controller
{
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $Receivable = customer_dept::join('account_journals', 'customer_debt.journal', '=', 'account_journals.id')
                                    ->join('res_customers', 'customer_debt.customer_id', '=', 'res_customers.id')
                                    ->select('customer_debt.*', 'account_journals.code','account_journals.default_credit_account_id','res_customers.name')
                                    ->orderBy('invoice_no','asc')
                                    ->where('status','UNPAID')->paginate('10');
        // dd($Receivable);
        return view('receivable.index', compact('access','group','Receivable'));
    }
    public function print()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $Receivable = customer_dept::join('account_journals', 'customer_debt.journal', '=', 'account_journals.id')
                                    ->join('res_customers', 'customer_debt.customer_id', '=', 'res_customers.id')
                                    ->select('customer_debt.*', 'account_journals.code','account_journals.default_credit_account_id','res_customers.name')
                                    ->orderBy('invoice_no','asc')
                                    ->where('status','UNPAID')->paginate('10');
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadview('reports.accounting.receivable_pdf', compact('access','group','Receivable'));
        return $pdf->stream();
    }
}
