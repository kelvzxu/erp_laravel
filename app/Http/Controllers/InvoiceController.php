<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Sales\Invoice;
use App\Models\Sales\InvoiceProduct;
use App\Models\Product\Product;
use App\Models\Customer\res_customer;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::join('res_customers', 'invoices.client', '=', 'res_customers.id')
                    ->select('invoices.*', 'res_customers.name')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
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
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $customer = res_customer::orderBy('name', 'asc')->get();
        $product = Product::orderBy('name', 'asc')->get();
        return view('invoices.create', compact('product','customer'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client' => 'required|max:255',
            'invoice_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'title' => 'required|max:255',
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
        $invoice = Invoice::with('products')->findOrFail($id);
        $customer = res_customer::orderBy('name', 'asc')->get();
        return view('invoices.show', compact('invoice','customer'));
    }

    public function edit($id)
    {
        $invoice = Invoice::where('id', $id)->with('products', 'products.product')->first();
        $invoices = InvoiceProduct::where('invoice_id', $id)->get();
        // dump($invoice);
        return view('invoices.edit', compact('invoice','invoices'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'invoice_no' => 'required|alpha_dash|unique:invoices,invoice_no,'.$id.',id',
            'client' => 'required|max:255',
            'client_address' => 'required|max:255',
            'invoice_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'title' => 'required|max:255',
            'discount' => 'required|numeric|min:0',
            'products.*.name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);

        $invoice = Invoice::findOrFail($id);

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
        $invoice = Invoice::with('products','customer')->findOrFail($id);
        // dd($invoice);
    	$pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadview('reports.sales.invoice_pdf', compact('invoice'));
    	return $pdf->stream();
    }
}
