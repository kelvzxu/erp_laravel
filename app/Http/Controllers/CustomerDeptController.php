<?php

namespace App\Http\Controllers;

use App\Models\Customer\customer_dept;
use App\Models\Customer\res_customer;
use Illuminate\Http\Request;

class CustomerDeptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = res_customer::orderBy('name', 'asc')->where('debit_limit','>',0)->paginate(10);
        return view('customer_dept.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer_dept  $customer_dept
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customerdebt = customer_dept::join('res_customers', 'customer_debt.customer_id', '=', 'res_customers.id')
                                        ->select('customer_debt.*', 'res_customers.name')
                                        ->orderBy('invoice_date', 'asc')
                                        ->where([ ['status', 'UNPAID'],['customer_id',$id] ])->paginate(10);
        return view('customer_dept.show', compact('customerdebt'));
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer_dept  $customer_dept
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer_debt = customer_dept::join('res_customers', 'customer_debt.customer_id', '=', 'res_customers.id')
                                        ->select('customer_debt.*', 'res_customers.name','res_customers.credit_limit')
                                        ->where('invoice_no', $id)->get();
        return view('customer_dept.edit', compact('customer_debt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer_dept  $customer_dept
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        echo"ok";
        try {
            $customer_debt = customer_dept::where('invoice_no',$request->invoice_no)->update([
                'payment' => $request->payment,
                'over' => $request->over,
                'status' => $request->status,
            ]);
            $credit="0";
            $customer = res_customer::where('id',$request->customer_id);
            $customer->update([
                'credit_limit' => $credit,
            ]);

            return redirect(route('CustomerDebt'))
                ->with(['success' => 'Payment Inoice No:<strong>' . $request->invoice_no . '</strong> created succesfully']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer_dept  $customer_dept
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer_dept $customer_dept)
    {
        //
    }
}
