<?php

namespace App\Http\Controllers;

use App\access_right;
use App\User;
use App\Models\Accounting\account_payment_invoice;
use App\Models\Accounting\account_journal;
use App\Models\Company\res_company;
use App\Models\Customer\res_customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountPaymentInvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $data= account_payment_invoice::with('company','partner','journal')->orderBy('name', 'ASC')->paginate(25);
        return view ('accounting.payments.invoice.index',compact('data','access','group'));
    }

    public function create()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $journal = account_journal::where('type','Cash')->orWhere('type','Bank')->orderBy('name','asc')->get();
        $company = res_company::find(1);
        $partner = res_customer::orderBy('name','ASC')->get();
        return view ('accounting.payments.invoice.create',compact('company','journal','partner','access','group'));
    }

    public function store(Request $request)
    {
        $year=date("Y");
        $prefixcode = "CUST.IN/$year/";
        $count = account_payment_invoice::all()->count();
        if ($count==0){
            $payment_no= "$prefixcode"."000001";
        }else {
            $latestPo = account_payment_invoice::orderBy('id','DESC')->first();
            $payment_no = $prefixcode.str_pad($latestPo->id + 1, 6, "0", STR_PAD_LEFT);
        }
        $code_journal=account_journal::find($request->journal_id);
        $prefixcode = "$code_journal->code/$year/";
        $sum = account_payment_invoice::where('move_name','like',"%".$code_journal->code."%")->count();
        if ($sum==0){
            $move_name= "$prefixcode"."000001";
        }else {
            $move_name = $prefixcode.str_pad($sum + 1, 6, "0", STR_PAD_LEFT);
        }
        $partner = res_customer::find($request->partner_id);
        account_payment_invoice::create([
            'name'=>$payment_no,
            'move_name'=>$move_name,
            'company_id'=>1,
            'state'=>"draft",
            'payment_type'=>$request->payment_type,
            'payment_method_id'=>$request->payment_method,
            'partner_type'=>$request->partner_type,
            'partner_id'=>$request->partner_id,
            'amount'=>$request->amount,
            'currency_id'=>$partner->currency_id,
            'payment_date'=>$request->payment_date,
            'journal_id'=>$request->journal_id,
            'payment_difference_handling'=>"open",
            'bank_reference'=>$request->bank_reference,
            'cheque_reference'=>$request->cheque_reference,
            'communication'=>$request->communication,
            'create_uid'=>Auth::id(),
        ]);
        $payment = account_payment_invoice::where('name',$payment_no)->first();
        Toastr::success('Register Payment Successfully','Success');
        return redirect(route('payment_invoices.view', $payment->id));
    }

    public function view($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $data= account_payment_invoice::with('company','partner','journal')->findOrFail($id);
        return view ('accounting.payments.invoice.view',compact('data','access','group'));
    }
}
