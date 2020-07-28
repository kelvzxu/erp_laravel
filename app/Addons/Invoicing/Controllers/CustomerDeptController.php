<?php

namespace App\Addons\Invoicing\Controllers;

use App\Http\Controllers\controller as Controller;
use App\Addons\Invoicing\Models\customer_dept;
use App\Addons\Contact\Models\res_customer;
use Illuminate\Http\Request;
use PDF;
use Auth;
use Invoicing;

class CustomerDeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = res_customer::orderBy('name', 'asc')->where('debit','>',0)->paginate(30);
        return view('customer_dept.index', compact('customer'));
    }

    public function show($id)
    {
        $customerdebt = customer_dept::join('res_customers', 'customer_debt.customer_id', '=', 'res_customers.id')
                                        ->select('customer_debt.*', 'res_customers.name')
                                        ->orderBy('invoice_date', 'asc')
                                        ->where([ ['status', 'UNPAID'],['customer_id',$id] ])->paginate(10);
        return view('customer_dept.show', compact('customerdebt'));
    } 

    public function edit($id)
    {
        $customer_debt = customer_dept::join('res_customers', 'customer_debt.customer_id', '=', 'res_customers.id')
                                        ->select('customer_debt.*', 'res_customers.name','res_customers.credit')
                                        ->where('invoice_no', $id)->get();
        return view('customer_dept.edit', compact('customer_debt'));
    }

    public function update(Request $request)
    {
        try {
            $customer_debt = customer_dept::where('invoice_no',$request->invoice_no)->update([
                'payment' => $request->payment,
                'over' => $request->over,
                'status' => $request->status,
            ]);
            $invoice = Invoicing::getInvoiceByInvoiceNo($request->invoice_no);
            $invoice->update([
                'paid'=> True,
            ]);
            $customer = res_customer::findOrFail($request->partner_id);
            $debit = $customer->debit; 
            $debit = $debit - $request->payment;
            $customer->update([
                'credit' => $request->over,
                'debit'=> $debit,
            ]);

            return redirect(route('CustomerDebt'))
                ->with(['success' => 'Payment Inoice No:<strong>' . $request->invoice_no . '</strong> created succesfully']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    public function report()
    {
        $debit=res_customer::sum('debit');
        $credit=res_customer::sum('credit');
        $customer = res_customer::orderBy('name', 'asc')->where(function ($query) {
                                                                                    $query->where('debit','>',0)
                                                                                        ->orWhere('credit','>',0);
                                                                                    })
                                                        ->paginate(30);
        return view('customer_dept.report', compact('credit','debit','customer'));
    }
    public function report_print()
    {
        $debit=res_customer::sum('debit');
        $credit=res_customer::sum('credit');
        $customer = res_customer::orderBy('name', 'asc')->where(function ($query) {
                                                                                    $query->where('debit','>',0)
                                                                                        ->orWhere('credit','>',0);
                                                                                    })
                                                        ->paginate(100);
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadview('reports.customer.customer_credit_report_pdf', compact('credit','debit','customer'));
        return $pdf->stream();
    }
}
