<?php

namespace App\Addons\Accounting\Controllers;

use App\Addons\Accounting\Models\account_account;
use App\Addons\Accounting\Models\account_journal;
use App\Addons\Accounting\Models\account_account_type;
use App\Addons\Accounting\Models\account_move;
use App\Addons\Accounting\Models\account_move_line;
use App\Addons\Accounting\Models\account_payment;
use App\Models\Customer\res_customer;
use App\Models\Merchandises\Purchase;
use App\Models\Partner\res_partner;
use App\Models\Product\Product;
use App\Models\Sales\Invoice;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\controller as Controller;

class AccountMovesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    public function invoice($id)
    {
        try{
            $invoice = invoice::with('products')->findOrFail($id);
            $partner = res_customer::findOrFail($invoice->client);
            $account_move = account_move::insertGetId([
                'name'=>$invoice->invoice_no,
                'date'=>date('Y-m-d H:i:s'),
                'state'=>'Posted',
                'type'=>'out_invoice',
                'journal_id'=>$partner->journal,
                'company_id'=>'1',
                'currency_id'=>$partner->currency_id,
                'partner_id'=>$invoice->client,
                'amount_untaxed'=>$invoice->grand_total,
                'amount_tax'=>0,
                'amount_total'=>$invoice->grand_total + 0,
                'amount_residual'=>$invoice->grand_total + 0,
                'amount_untaxed_signed'=>$invoice->grand_total,
                'amount_tax_signed'=>0,
                'amount_total_signed'=>$invoice->grand_total + 0,
                'amount_residual_signed'=>$invoice->grand_total + 0,
                'fiscal_position_id'=>0,
                'invoice_id'=>$id,
                'invoice_payment_state'=>"Not_Paid",
                'invoice_date'=>$invoice->invoice_date,
                'invoice_date_due'=>$invoice->due_date,
                'invoice_partner_display_name'=>$partner->name,
                'create_uid'=>Auth::id(),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            foreach($invoice->products as $e => $data){
                $product = Product::find($data->name);
                $account = account_account::find($product->income_account);
                account_move_line::create([
                    'account_move_id'=>$account_move,
                    'account_move_name'=>$invoice->invoice_no,
                    'date'=>date('Y-m-d H:i:s'),
                    'parent_state'=>"Posted",
                    'journal_id'=>$partner->journal,
                    'company_id'=>1,
                    'company_currency_id'=>12,
                    'account_id'=>$product->income_account,
                    'account_internal_type'=>$account->internal_type,
                    'product_id'=>$data->name,
                    'name'=>$product->name,
                    'quantity'=>$data->qty,
                    'price_unit'=>$data->price,
                    'price_total'=>$data->total,
                    'debit'=>0,
                    'credit'=>$data->total,
                    'balance'=>0 - $data->total,
                    'currency_id'=>$partner->currency_id,
                    'partner_id'=>$invoice->client,
                    'create_uid'=>Auth::id(),
                ]);
            }
            $account = account_account::find($partner->receivable_account);
            account_move_line::create([
                'account_move_id'=>$account_move,
                'account_move_name'=>$invoice->invoice_no,
                'date'=>date('Y-m-d H:i:s'),
                'parent_state'=>"Posted",
                'journal_id'=>$partner->journal,
                'company_id'=>1,
                'company_currency_id'=>12,
                'account_id'=>$partner->receivable_account,
                'account_internal_type'=>$account->internal_type,
                'name'=>$invoice->invoice_no,
                'quantity'=>1,
                'price_unit'=>"-$invoice->grand_total",
                'price_total'=>"-$invoice->grand_total",
                'debit'=>$invoice->grand_total,
                'credit'=>0,
                'balance'=>$invoice->grand_total - 0,
                'currency_id'=>$partner->currency_id,
                'partner_id'=>$invoice->client,
                'create_uid'=>Auth::id(),
            ]);
            Toastr::success('Invoice '.$invoice->invoice_no .' Posted Success','Success');
            return redirect(route('invoices'));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function purchase($id)
    {
        try{
            $invoice = purchase::with('products')->findOrFail($id);
            $partner = res_partner::findOrFail($invoice->client);
            $account_move = account_move::insertGetId([
                'name'=>$invoice->purchase_no,
                'date'=>date('Y-m-d H:i:s'),
                'state'=>'Posted',
                'type'=>'in_invoice',
                'journal_id'=>$partner->journal,
                'company_id'=>'1',
                'currency_id'=>$partner->currency_id,
                'partner_id'=>$invoice->client,
                'amount_untaxed'=>$invoice->grand_total,
                'amount_tax'=>0,
                'amount_total'=>$invoice->grand_total + 0,
                'amount_residual'=>$invoice->grand_total + 0,
                'amount_untaxed_signed'=>$invoice->grand_total,
                'amount_tax_signed'=>0,
                'amount_total_signed'=>$invoice->grand_total + 0,
                'amount_residual_signed'=>$invoice->grand_total + 0,
                'fiscal_position_id'=>0,
                'invoice_id'=>$id,
                'invoice_payment_state'=>"Not_Paid",
                'invoice_date'=>$invoice->purchase_date,
                'invoice_date_due'=>$invoice->due_date,
                'invoice_partner_display_name'=>$partner->partner_name,
                'create_uid'=>Auth::id(),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            foreach($invoice->products as $e => $data){
                $product = Product::find($data->name);
                $account = account_account::find($product->expense_account);
                account_move_line::create([
                    'account_move_id'=>$account_move,
                    'account_move_name'=>$invoice->purchase_no,
                    'date'=>date('Y-m-d H:i:s'),
                    'parent_state'=>"Posted",
                    'journal_id'=>$partner->journal,
                    'company_id'=>1,
                    'company_currency_id'=>12,
                    'account_id'=>$product->expense_account,
                    'account_internal_type'=>$account->internal_type,
                    'product_id'=>$data->name,
                    'name'=>$product->name,
                    'quantity'=>$data->qty,
                    'price_unit'=>$data->price,
                    'price_total'=>$data->total,
                    'debit'=>$data->total,
                    'credit'=>0,
                    'balance'=>$data->total - 0,
                    'currency_id'=>$partner->currency_id,
                    'partner_id'=>$invoice->client,
                    'create_uid'=>Auth::id(),
                ]);
            }
            $account = account_account::find($partner->receivable_account);
            account_move_line::create([
                'account_move_id'=>$account_move,
                'account_move_name'=>$invoice->purchase_no,
                'date'=>date('Y-m-d H:i:s'),
                'parent_state'=>"Posted",
                'journal_id'=>$partner->journal,
                'company_id'=>1,
                'company_currency_id'=>12,
                'account_id'=>$partner->receivable_account,
                'account_internal_type'=>$account->internal_type,
                'name'=>$invoice->purchase_no,
                'quantity'=>1,
                'price_unit'=>"-$invoice->grand_total",
                'price_total'=>"-$invoice->grand_total",
                'debit'=>0,
                'credit'=>$invoice->grand_total,
                'balance'=>0 - $invoice->grand_total,
                'currency_id'=>$partner->currency_id,
                'partner_id'=>$invoice->client,
                'create_uid'=>Auth::id(),
            ]);
            Toastr::success('BILL '.$invoice->purchase_no .' Posted Success','Success');
            return redirect(route('purchases'));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function payment($id)
    {
        try{
            $payment = account_payment::find($id);
            $journal = account_journal::find($payment->journal_id);
            $payment_account = account_account::where('code',$journal->default_debit_account_id)->first();
            if ($payment->partner_type =="customer"){
                $partner = res_customer::find($payment->partner_id);
                $name = $partner->name;
                $type = "Customer Payment";
                $debit = $payment->amount;
                $credit = 0;
                $balance = $payment->amount - 0;
                $debit1 = 0;
                $credit1 = $payment->amount;
                $balance1 = 0 -$payment->amount;
            } else {
                $partner = res_partner::find($payment->partner_id);
                $name = $partner->partner_name;
                $type = "Vendor Payment";
                $debit = 0;
                $credit = $payment->amount;
                $balance = 0 -$payment->amount;
                $debit1 = $payment->amount;
                $credit1 = 0;
                $balance1 = $payment->amount - 0;
            }
            $account = account_account::find($partner->receivable_account);
            $account_move = account_move::insertGetId([
                'name'=>$payment->name,
                'date'=>date('Y-m-d H:i:s'),
                'state'=>'Posted',
                'type'=>'entry',
                'journal_id'=>$payment->journal_id,
                'company_id'=>'1',
                'currency_id'=>'12',
                'partner_id'=>$payment->partner_id,
                'amount_untaxed'=>0,
                'amount_tax'=>0,
                'amount_total'=>$payment->amount,
                'amount_residual'=>0,
                'amount_untaxed_signed'=>0,
                'amount_tax_signed'=>0,
                'amount_total_signed'=>0,
                'amount_residual_signed'=>$payment->amount,
                'fiscal_position_id'=>0,
                'invoice_partner_display_name'=>$name,
                'create_uid'=>Auth::id(),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            account_move_line::create([
                'account_move_id'=>$account_move,
                'account_move_name'=>$payment->name,
                'date'=>date('Y-m-d H:i:s'),
                'parent_state'=>"Posted",
                'journal_id'=>$payment->journal_id,
                'company_id'=>1,
                'company_currency_id'=>12,
                'account_id'=>$partner->receivable_account,
                'account_internal_type'=>$account->internal_type,
                'name'=>$type,
                'quantity'=>1,
                'price_unit'=>"0",
                'price_total'=>"0",
                'debit'=>$debit1,
                'credit'=>$credit1,
                'balance'=>$balance1,
                'currency_id'=>$partner->currency_id,
                'partner_id'=>$payment->partner_id,
                'payment_id'=>$id,
                'create_uid'=>Auth::id(),
            ]);
            account_move_line::create([
                'account_move_id'=>$account_move,
                'account_move_name'=>$payment->name,
                'date'=>date('Y-m-d H:i:s'),
                'parent_state'=>"Posted",
                'journal_id'=>$payment->journal_id,
                'company_id'=>1,
                'company_currency_id'=>12,
                'account_id'=>$payment_account->id,
                'account_internal_type'=>$payment_account->internal_type,
                'name'=>$payment->name,
                'quantity'=>1,
                'price_unit'=>"0",
                'price_total'=>"0",
                'debit'=>$debit,
                'credit'=>$credit,
                'balance'=>$balance,
                'currency_id'=>$partner->currency_id,
                'partner_id'=>$payment->partner_id,
                'payment_id'=>$id,
                'create_uid'=>Auth::id(),
            ]);
            Toastr::success('Confirm Payment Successfully','Success');
            return redirect(route('payment.view', $id));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }
}
