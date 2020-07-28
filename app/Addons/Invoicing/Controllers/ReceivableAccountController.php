<?php

namespace App\Addons\Invoicing\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Invoicing\Models\customer_dept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ReceivableAccountController extends Controller
{
    public function index()
    {
        $Receivable = customer_dept::join('account_journals', 'customer_debt.journal', '=', 'account_journals.id')
                                    ->join('res_customers', 'customer_debt.customer_id', '=', 'res_customers.id')
                                    ->select('customer_debt.*', 'account_journals.code','account_journals.default_credit_account_id','res_customers.name')
                                    ->orderBy('invoice_no','asc')
                                    ->where('status','UNPAID')->paginate('10');
        // dd($Receivable);
        return view('receivable.index', compact('Receivable'));
    }
    public function print()
    {
        $Receivable = customer_dept::join('account_journals', 'customer_debt.journal', '=', 'account_journals.id')
                                    ->join('res_customers', 'customer_debt.customer_id', '=', 'res_customers.id')
                                    ->select('customer_debt.*', 'account_journals.code','account_journals.default_credit_account_id','res_customers.name')
                                    ->orderBy('invoice_no','asc')
                                    ->where('status','UNPAID')->paginate('10');
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadview('reports.accounting.receivable_pdf', compact('Receivable'));
        return $pdf->stream();
    }
}
