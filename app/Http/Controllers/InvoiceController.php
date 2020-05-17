<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Customer\customer_dept;
use App\Models\Sales\Invoice;
use App\Models\Sales\InvoiceProduct;
use App\Models\Product\Product;
use App\Models\Customer\res_customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $invoices = Invoice::join('res_customers', 'invoices.client', '=', 'res_customers.id')
                    ->select('invoices.*', 'res_customers.name')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        return view('invoices.index', compact('access','group','invoices'));
    }

    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        if ($key!=""){
            $invoices = Invoice::join('res_customers', 'invoices.client', '=', 'res_customers.id')
                    ->select('invoices.*', 'res_customers.name')
                    ->orderBy('created_at', 'desc')
                    ->where($key,'like',"%".$value."%")
                    ->paginate(10);
            $invoices ->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
        }else{
            $invoices = Invoice::join('res_customers', 'invoices.client', '=', 'res_customers.id')
                    ->select('invoices.*', 'res_customers.name')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        }
        return view('invoices.index', compact('access','group','invoices'));
    }

    public function create()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $customer = res_customer::orderBy('name', 'asc')->get();
        $product = Product::orderBy('name', 'asc')->get();
        return view('invoices.create', compact('access','group','product','customer'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client' => 'required|max:255',
            'invoice_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);
        $year=date("Y");
        $prefixcode = "INV-$year-";
        $count = Invoice::all()->count();
        if ($count==0){
            $invoice_no= "$prefixcode"."000001";
        }else {
            $latestInv = Invoice::orderBy('id','DESC')->first();
            $invoice_no = $prefixcode.str_pad($latestInv->id + 1, 6, "0", STR_PAD_LEFT);
        }

        echo $request->invoice_no;
        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['qty'] * $product['price'];
            return new InvoiceProduct($product);
        });

        if($products->isEmpty()) {
            return response()
            ->json([
                'products_empty' => ['One or more Product is required.']
            ], 422);
        }

        $data = $request->except('products');
        $data['invoice_no'] = $invoice_no;
        $data['sales'] = Auth::id();
        $data['sub_total'] = $products->sum('total');
        $data['grand_total'] = $data['sub_total'] - $data['discount'];

        $invoice = Invoice::create($data);

        $invoice->products()->saveMany($products);

        return response()
            ->json([
                'created' => 'success',
                'id' => $invoice->id
            ]);
    }

    public function show($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $invoice = Invoice::with('products')->findOrFail($id);
        $customer = res_customer::orderBy('name', 'asc')->get();
        return view('invoices.show', compact('access','group','invoice','customer'));
    }

    public function edit($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $invoice = Invoice::where('id', $id)->with('products', 'products.product')->first();
        $invoices = InvoiceProduct::where('invoice_id', $id)->get();
        // dump($invoice);
        return view('invoices.edit', compact('access','group','invoice','invoices'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'invoice_no' => 'required|alpha_dash|unique:invoices,invoice_no,'.$id.',id',
            'client' => 'required|max:255',
            'invoice_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);

        $invoice = Invoice::findOrFail($id);
        $old_total = $invoice->grand_total;

        $products = collect($request->products)->transform(function($product) {
            $product['total'] = $product['qty'] * $product['price'];
            return new InvoiceProduct($product);
        });

        if($products->isEmpty()) {
            return response()
            ->json([
                'products_empty' => ['One or more Product is required.']
            ], 422);
        }

        $data = $request->except('products');
        $data['sub_total'] = $products->sum('total');
        $data['grand_total'] = $data['sub_total'] - $data['discount'];

        $invoice->update($data);

        InvoiceProduct::where('invoice_id', $invoice->id)->delete();

        $invoice->products()->saveMany($products);

        customer_dept::where('invoice_no',$request->invoice_no)->update([
            'total'=>$data['grand_total'],
        ]);

        $partner = res_customer::findOrFail($request->client);
        $oldbalance = $partner->debit_limit;
        $total = $oldbalance - $old_total;
        $new_balance = $data['grand_total'] + $total; 
        $partner->update([
            'debit_limit' => $new_balance,
        ]);

        return response()
            ->json([
                'updated' => "success",
                'id' => $invoice->id
            ]);
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        InvoiceProduct::where('invoice_id', $invoice->id)
            ->delete();

        $invoice->delete();

        return redirect()
            ->route('invoices.index');
    }

    public function print_pdf($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $invoice = Invoice::with('products','customer')->findOrFail($id);
        // dd($invoice);
    	$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadview('reports.sales.invoice_pdf', compact('access','group','invoice'));
    	return $pdf->stream();
    }
    public function approved($id)
    {
        try{
            $invoice = invoice::findOrFail($id);
            $customer = res_customer::findOrFail($invoice->client);
            $journal = $customer->receivable_account;
            $balance = $customer->debit_limit;
            $new_balance = intval($balance) + intval($invoice->grand_total);
            customer_dept::insert([
                'invoice_no'=>$invoice->invoice_no,
                'journal'=>$journal,
                'customer_id'=>$invoice->client,
                'invoice_date'=>$invoice->invoice_date,
                'due_date'=>$invoice->due_date,
                'total'=>$invoice->grand_total,
            ]);
            $customer->update([
                'debit_limit' => $new_balance,
            ]);
            $invoice->update([
                'approved'=> True,
                'status'=>"Complete",
            ]);
            Toastr::success('Invoice '.$invoice->invoice_no .' Posted Success','Success');
            return redirect(route('invoices'));
        }catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }

    }
    public function Report()
    {
        $month = date('m');
        $year = date('Y');
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $income=invoice::whereMonth('invoice_date', '=', $month)->whereYear('invoice_date', '=', $year)->sum('grand_total');
        $unpaid=invoice::where('paid','0')->whereMonth('invoice_date', '=', $month)->whereYear('invoice_date', '=', $year)->count();
        $notvalidate=invoice::where('approved','0')->whereMonth('invoice_date', '=', $month)->whereYear('invoice_date', '=', $year)->count();
        $invoices = Invoice::with('payment')->join('res_customers', 'invoices.client', '=', 'res_customers.id')
                    ->select('invoices.*', 'res_customers.name')
                    ->orderBy('created_at', 'desc')
                    ->whereMonth('invoice_date', '=', $month)->whereYear('invoice_date', '=', $year)
                    ->paginate(10);
        return view('invoices.report', compact('access','group','income','unpaid','notvalidate','invoices'));
    }
}
 