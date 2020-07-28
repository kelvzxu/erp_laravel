<?php

namespace App\Addons\Accounting\Controllers;

use App\Addons\Accounting\Models\account_payment;
use App\Addons\Accounting\Models\account_journal;
use App\Models\Company\res_company;
use App\Addons\Contact\Models\res_customer;
use App\Addons\Contact\Models\res_partner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\controller as Controller;

class AccountPaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data= account_payment::with('company','partner','journal')->where('partner_type','customer')->orderBy('name', 'DESC')->paginate(25);
        return view ('accounting.payments.invoice.index',compact('data'));
    }

    public function vendor_index()
    {
        $data= account_payment::with('company','vendor','journal')->where('partner_type','vendor')->orderBy('name', 'DESC')->paginate(25);
        return view ('accounting.payments.bill.index',compact('data'));
    }

    public function create()
    {
        $journal = account_journal::where('type','Cash')->orWhere('type','Bank')->orderBy('name','asc')->get();
        $company = res_company::find(1);
        $partner = res_customer::orderBy('name','ASC')->get();
        return view ('accounting.payments.invoice.create',compact('company','journal','partner'));
    }

    public function vendor_create()
    {
        $journal = account_journal::where('type','Cash')->orWhere('type','Bank')->orderBy('name','asc')->get();
        $company = res_company::find(1);
        $partner = res_partner::orderBy('partner_name','ASC')->get();
        return view ('accounting.payments.bill.create',compact('company','journal','partner'));
    }

    public function store(Request $request)
    {
        try{
            $year=date("Y");
            if ($request->partner_type == "customer")
            {
                $prefixcode = "CUST.IN/$year/";
                $partner = res_customer::find($request->partner_id);
            }else if ($request->partner_type == "vendor")
            {
                $prefixcode = "SUPP.OUT/$year/";
                $partner = res_partner::find($request->partner_id);
            }
            $count = account_payment::where('name','like',"%".$prefixcode."%")->count();
            if ($count==0){
                $payment_no= "$prefixcode"."000001";
            }else {
                $payment_no = $prefixcode.str_pad($count + 1, 6, "0", STR_PAD_LEFT);
            }
            $code_journal=account_journal::find($request->journal_id);
            $prefixcode = "$code_journal->code/$year/";
            $sum = account_payment::where('move_name','like',"%".$code_journal->code."%")->count();
            if ($sum==0){
                $move_name= "$prefixcode"."000001";
            }else {
                $move_name = $prefixcode.str_pad($sum + 1, 6, "0", STR_PAD_LEFT);
            }
            account_payment::create([
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
            $payment = account_payment::where('name',$payment_no)->first();
            Toastr::success('Register Payment Successfully','Success');
            return redirect(route('payment.view', $payment->id));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function view($id)
    {
        $payment = account_payment::find($id);
        if ($payment->partner_type =="customer")
        {
            $data= account_payment::with('company','partner','journal')->findOrFail($id);
            return view ('accounting.payments.invoice.view',compact('data'));
        } else {
            $data= account_payment::with('company','vendor','journal')->findOrFail($id);
            return view ('accounting.payments.bill.view',compact('data'));
        }
    }
    
    public function edit($id)
    {
        $journal = account_journal::where('type','Cash')->orWhere('type','Bank')->orderBy('name','asc')->get();
        $payment = account_payment::find($id);
        $company = res_company::find(1);
        if ($payment->partner_type =="customer")
        {
            $partner = res_customer::orderBy('name','ASC')->get();
            $data= account_payment::with('company','partner','journal')->findOrFail($id);
            return view ('accounting.payments.invoice.edit',compact('company','data','journal','partner'));
        } else{
            $partner = res_partner::orderBy('partner_name','ASC')->get();
            $data= account_payment::with('company','vendor','journal')->findOrFail($id);
            return view ('accounting.payments.bill.edit',compact('company','data','journal','partner'));
        }
    }

    public function update(Request $request)
    {
        try{
            if ($request->partner_type == "customer")
            {
                $partner = res_customer::find($request->partner_id);
            }else if ($request->partner_type == "vendor")
            {
                $partner = res_partner::find($request->partner_id);
            }
            $payment= account_payment::findOrFail($request->id);
            $payment->update([
                'payment_type'=>$request->payment_type,
                'payment_method_id'=>$request->payment_method,
                'partner_type'=>$request->partner_type,
                'partner_id'=>$request->partner_id,
                'amount'=>$request->amount,
                'currency_id'=>$partner->currency_id,
                'payment_date'=>$request->payment_date,
                'journal_id'=>$request->journal_id,
                'bank_reference'=>$request->bank_reference,
                'cheque_reference'=>$request->cheque_reference,
                'communication'=>$request->communication,
            ]);
            if ($request->partner_type == "customer")
            {
                Toastr::success('Payment Update Successfully','Success');
                return redirect(route('payment.view', $payment->id));
            }else if ($request->partner_type == "vendor")
            {
                Toastr::success('Payment Update Successfully','Success');
                return redirect(route('payment.view', $payment->id));
            }
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function posted($id)
    {
        try{

            $access=access_right::where('user_id',Auth::id())->first();
            $group=user::find(Auth::id());
            $payment = account_payment::find($id);
            if ($payment->partner_type =="customer")
            {
                $partner = res_customer::find($payment->partner_id);
                $credit = $partner->credit + $payment->amount;
                $partner->update([
                    'credit'=> $credit,
                ]);
                $payment->update([
                    'state'=>"posted"
                ]);
            } else {
                $partner = res_partner::find($payment->partner_id);
                $credit = $partner->credit + $payment->amount;
                $partner->update([
                    'credit'=> $credit,
                ]);
                $payment->update([
                    'state'=>"posted"
                ]);
            }
            return redirect(route('accountmove.payment',$id));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }
}
