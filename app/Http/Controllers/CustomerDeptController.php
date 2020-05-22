<?php

namespace App\Http\Controllers;

use App\Models\Customer\customer_dept;
use App\Models\Customer\res_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sales\Invoice;
use App\access_right;
use App\User;
use PDF;

class CustomerDeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $customer = res_customer::orderBy('name', 'asc')->where('debit_limit','>',0)->paginate(30);
        return view('customer_dept.index', compact('access','group','customer','access','group'));
    }

    public function show($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $customerdebt = customer_dept::join('res_customers', 'customer_debt.customer_id', '=', 'res_customers.id')
                                        ->select('customer_debt.*', 'res_customers.name')
                                        ->orderBy('invoice_date', 'asc')
                                        ->where([ ['status', 'UNPAID'],['customer_id',$id] ])->paginate(10);
        return view('customer_dept.show', compact('access','group','customerdebt'));
    } 

    public function edit($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $customer_debt = customer_dept::join('res_customers', 'customer_debt.customer_id', '=', 'res_customers.id')
                                        ->select('customer_debt.*', 'res_customers.name','res_customers.credit_limit')
                                        ->where('invoice_no', $id)->get();
        return view('customer_dept.edit', compact('access','group','customer_debt','access','group'));
    }

    public function update(Request $request)
    {
        try {
            $customer_debt = customer_dept::where('invoice_no',$request->invoice_no)->update([
                'payment' => $request->payment,
                'over' => $request->over,
                'status' => $request->status,
            ]);
            $invoice = invoice::where('invoice_no',$request->invoice_no)->update([
                'paid'=> True,
            ]);
            $customer = res_customer::findOrFail($request->partner_id);
            $debit = $customer->debit_limit; 
            $debit_limit = $debit - $request->payment;
            $customer->update([
                'credit_limit' => $request->over,
                'debit_limit'=> $debit_limit,
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
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $debit=res_customer::sum('debit_limit');
        $credit=res_customer::sum('credit_limit');
        $customer = res_customer::orderBy('name', 'asc')->where('debit_limit','>',0)->paginate(30);
        return view('customer_dept.report', compact('access','group','credit','debit','customer','access','group'));
    }
    public function report_print()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $debit=res_customer::sum('debit_limit');
        $credit=res_customer::sum('credit_limit');
        $customer = res_customer::orderBy('name', 'asc')->where('debit_limit','>',0)->paginate(30);
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->loadview('reports.customer.customer_credit_report_pdf', compact('access','group','credit','debit','customer'));
        return $pdf->stream();
    }
}
