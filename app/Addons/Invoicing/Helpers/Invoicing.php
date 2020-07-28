<?php
namespace App\Addons\Invoicing\Helpers;

use Artisan;
use App\Addons\Invoicing\Models\Invoice;
use App\Addons\Invoicing\Models\InvoiceProduct;
use App\Addons\Invoicing\Models\Bill;
use App\Addons\Invoicing\Models\BillProduct;
use Illuminate\Http\Request;

class Invoicing {
    public static function installed(){
        try{
            Artisan::call('migrate', array('--path' => 'app/Addons/Invoicing/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            echo $e;
        }
    }

    public static function uninstalled(){
        try{
            Artisan::call('migrate:rollback', array('--path' => 'app/Addons/Invoicing/Migrations', '--force' => true));
        }
        catch (\Exception $e){
            return false;
        }
    }

    public static function getInvoice($id){
        $invoice = Invoice::with('products','partner','products.product')->findOrFail($id);
        return $invoice;
    }

    public static function getBill($id){
        $bill = Bill::with('products','vendor','products.product')->findOrFail($id);
        return $bill ;
    }

    public static function getInvoiceByInvoiceNo($id){
        $invoice = Invoice::where('invoice_no', $id)->with('products','partner', 'products.product')->first();
        return $invoice;
    }

    public static function getInvoiceLine($id){
        $invoice =  InvoiceProduct::where('invoice_id', $id)->get();
        return $invoice;
    }

    public static function getBillByPurchaseNo($id) {
        $purchase = Bill::where('purchase_no',$request->purchase_no)->first();
        return $purchase;

    }
    
    public static function getBillLine($id){
        $bill = BillProduct::where('purchase_id', $id)->get();
    }



}