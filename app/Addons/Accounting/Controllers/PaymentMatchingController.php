<?php

namespace App\Addons\Accounting\Controllers;

use App\Addons\Accounting\Models\account_account;
use App\Addons\Accounting\Models\account_move;
use App\Addons\Accounting\Models\account_payment;
use App\Addons\Contact\Models\res_customer;
use App\Addons\Contact\Models\res_partner;
use App\Addons\Invoicing\Models\customer_dept;
use App\Addons\Invoicing\Models\Invoice;
use App\Addons\Invoicing\Models\partner_credit;
use App\Addons\Invoicing\Models\Purchase;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\controller as Controller;

class PaymentMatchingController extends Controller
{
    public function invoice($id)
    {
        $partner=res_customer::find($id);   
        $account=account_account::find($partner->receivable_account);
        $data=account_move::where([['type','out_invoice'],['partner_id',$id],['invoice_payment_state','Not_Paid']])->get();
        return view ('accounting.payment_matching.invoice.create',compact('account','data','partner','access','group'));
    }
    public function bill($id)
    {
        $partner=res_partner::find($id);   
        $account=account_account::find($partner->receivable_account);
        $data=account_move::where([['type','in_invoice'],['partner_id',$id],['invoice_payment_state','Not_Paid']])->get();
        return view ('accounting.payment_matching.bill.create',compact('account','data','partner','access','group'));
    }

    public function invoice_store(Request $request)
    {
        try{
            $partner=res_customer::find($request->id);
            $line = $request->name;
            $payment = $partner->credit - $request->amount_total;
            $debit = $partner->debit - $payment;
            $partner->update([
                'credit' =>$request->amount_total,
                'debit' => $debit,
            ]);
            foreach($line as $e => $data){
                customer_dept::where('invoice_no',$data)->update([
                    'payment'=>$request->amount[$e],
                    'status'=>"PAID",
                ]);
                account_move::where('name',$data)->update([
                    'invoice_payment_state'=>"Paid",
                ]);
                invoice::where('invoice_no',$data)->update([
                    'paid'=> True,
                ]);
            };
            Toastr::success('Reconcile Payment Successfully','Success');
            return redirect(route('payment_invoices.index'));
        } catch (\Exception $e) {
            // Toastr::error($e->getMessage(),'Something Wrong');
            Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function bill_store(Request $request)
    {
        try{
            $partner=res_partner::find($request->id);
            $line = $request->name;
            $payment = $partner->credit - $request->amount_total;
            $debit = $partner->debit - $payment;
            $partner->update([
                'credit' =>$request->amount_total,
                'debit' => $debit,
            ]);
            foreach($line as $e => $data){
                partner_credit::where('purchase_no',$data)->update([
                    'payment'=>$request->amount[$e],
                    'status'=>"PAID",
                ]);
                account_move::where('name',$data)->update([
                    'invoice_payment_state'=>"Paid",
                ]);
                Purchase::where('purchase_no',$data)->update([
                    'paid'=> True,
                ]);
            };
            Toastr::success('Reconcile Payment Successfully','Success');
            return redirect(route('payment_bills.index'));
        } catch (\Exception $e) {
            // Toastr::error($e->getMessage(),'Something Wrong');
            Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }
}
