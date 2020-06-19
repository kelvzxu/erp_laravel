<?php

namespace App\Http\Controllers;

use App\access_right;
use App\User;
use App\Models\Accounting\account_account;
use App\Models\Accounting\account_move;
use App\Models\Accounting\account_payment;
use App\Models\Customer\customer_dept;
use App\Models\Customer\res_customer;
use App\Models\Merchandises\Purchase;
use App\Models\Sales\Invoice;
use App\Models\Partner\res_partner;
use App\Models\Partner\partner_credit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMatchingController extends Controller
{
    public function invoice($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $partner=res_customer::find($id);   
        $account=account_account::find($partner->receivable_account);
        $data=account_move::where([['type','out_invoice'],['partner_id',$id],['invoice_payment_state','Not_Paid']])->get();
        return view ('accounting.payment_matching.invoice.create',compact('account','data','partner','access','group'));
    }
    public function bill($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
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
            $payment = $partner->credit_limit - $request->amount_total;
            $debit = $partner->debit_limit - $payment;
            $partner->update([
                'credit_limit' =>$request->amount_total,
                'debit_limit' => $debit,
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
            $payment = $partner->credit_limit - $request->amount_total;
            $debit = $partner->debit_limit - $payment;
            $partner->update([
                'credit_limit' =>$request->amount_total,
                'debit_limit' => $debit,
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
