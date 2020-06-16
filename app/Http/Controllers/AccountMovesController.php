<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Accounting\account_account;
use App\Models\Accounting\account_account_type;
use App\Models\Accounting\account_move;
use App\Models\Accounting\account_move_line;
use App\Models\Customer\res_customer;
use App\Models\Merchandises\Purchase;
use App\Models\Partner\res_partner;
use App\Models\Product\Product;
use App\Models\Sales\Invoice;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'name'=>$invoice->invoice_no,
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
                    'debit'=>$invoice->grand_total,
                    'credit'=>0,
                    'balance'=>$invoice->grand_total - 0,
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
                'credit'=>$data->total,
                'balance'=>0 - $data->total,
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
}
