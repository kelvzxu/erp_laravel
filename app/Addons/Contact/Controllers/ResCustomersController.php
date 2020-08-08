<?php

namespace App\Addons\Contact\Controllers;

use App\Addons\Contact\Models\res_customer;
use App\Models\Sales\Invoice;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\controller as Controller;

class ResCustomersController extends Controller
{
    public function index()
    {
        $customer = DB::table('res_customers')
                    ->join('res_country', 'res_customers.country_id', '=', 'res_country.id')
                    ->select('res_customers.*', 'res_country.country_name')
                    ->whereNull('res_customers.deleted_at')
                    ->orderBy('name', 'ASC')
                    ->paginate(30);
        return view('customer.index',compact('customer'));
    }

    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
        if ($key!=""){
            $customer = DB::table('res_customers')
                    ->join('res_country', 'res_customers.country_id', '=', 'res_country.id')
                    ->select('res_customers.*', 'res_country.country_name')
                    ->whereNull('res_customers.deleted_at')
                    ->orderBy('name', 'ASC')
                    ->where($key,'like',"%".$value."%")
                    ->paginate(30);
            $customer ->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
        }else{
            $customer = DB::table('res_customers')
                    ->join('res_country', 'res_customers.country_id', '=', 'res_country.id')
                    ->select('res_customers.*', 'res_country.country_name')
                    ->whereNull('res_customers.deleted_at')
                    ->orderBy('name', 'ASC')
                    ->paginate(30);
        }
        return view('customer.index',compact('customer'));
    }
    
    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        try {
            $nama_file="";
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/customers';
                $request->file('photo')->move($destination, $nama_file);
            }

            $res_customer = res_customer::create([
                'name'=> $request->name,
                'display_name'=> $request->name,
                'parent_id'=> $request->Parent_id,
                'ref'=> $request->reference,
                'lag'=> $request->lag,
                'tz'=> $request->tz,
                'currency_id'=> $request->currency_id,
                'bank_account'=> $request->bank_account,
                'website'=> $request->website,
                'credit'=> "0",
                'debit'=> "0",
                'active'=> $active=True,
                'address'=> $request->type,
                'street'=> $request->street1,
                'street2'=> $request->street2,
                'zip'=> $request->zip,
                'city'=> $request->city,
                'state_id'=> $request->state,
                'country_id'=> $request->country,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'mobile'=> $request->mobile,
                'industry_id'=> $request->industry_id,
                'sales'=> $request->sales,
                'payment_terms'=>$request->payment_terms,
                'note'=>$request->note,
                'logo'=> $nama_file,
            ]);

            Toastr::success('Customers ' .$request->name. ' created successfully','Success');
            return redirect(route('customer'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\res_customer  $res_customer
     * @return \Illuminate\Http\Response
     */
    public function show(res_customer $res_customer)
    {
        $invoice=Invoice::where('client',$res_customer->id)->count();
        return view('customer.edit_customer',
            compact('res_customer','invoice'));
    }

    /**
     * Show the form for editing the specified resource. 
     *
     * @param  \App\res_customer  $res_customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = res_customer::findOrFail($id);
        return view('customer.edit_customer', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\res_customer  $res_customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        try {
            $nama_file="";
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/customers';
                $request->file('photo')->move($destination, $nama_file);

                $res_customer = res_customer::where('id',$request->id)->update([
                    'name'=> $request->name,
                    'display_name'=> $request->name,
                    'parent_id'=> $request->Parent_id,
                    'ref'=> $request->reference,
                    'lag'=> $request->lag,
                    'tz'=> $request->tz,
                    'currency_id'=> $request->currency_id,
                    'bank_account'=> $request->bank_account,
                    'website'=> $request->website,
                    'active'=> $active=True,
                    'address'=> $request->type,
                    'street'=> $request->street1,
                    'street2'=> $request->street2,
                    'zip'=> $request->zip,
                    'city'=> $request->city,
                    'state_id'=> $request->state,
                    'country_id'=> $request->country,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                    'mobile'=> $request->mobile,
                    'industry_id'=> $request->industry_id,
                    'sales'=> $request->sales,
                    'payment_terms'=>$request->payment_terms,
                    'note'=>$request->note,
                    'receivable_account'=>$request->receivable_account,
                    'logo'=> $nama_file,
                    'journal'=> $request->journal,
                ]);
                Toastr::success('Customer ' .$request->name. ' update successfully','Success');
                return redirect(route('customer'));
            }
            else{
                $res_customer = res_customer::where('id',$request->id)->update([
                    'name'=> $request->name,
                    'display_name'=> $request->name,
                    'parent_id'=> $request->Parent_id,
                    'ref'=> $request->reference,
                    'lag'=> $request->lag,
                    'tz'=> $request->tz,
                    'currency_id'=> $request->currency_id,
                    'bank_account'=> $request->bank_account,
                    'website'=> $request->website,
                    'active'=> $active=True,
                    'address'=> $request->type,
                    'street'=> $request->street1,
                    'street2'=> $request->street2,
                    'zip'=> $request->zip,
                    'city'=> $request->city,
                    'state_id'=> $request->state,
                    'country_id'=> $request->country,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                    'mobile'=> $request->mobile,
                    'industry_id'=> $request->industry_id,
                    'sales'=> $request->sales,
                    'payment_terms'=>$request->payment_terms,
                    'note'=>$request->note,
                    'receivable_account'=>$request->receivable_account,
                    'journal'=> $request->journal,
                ]);
                Toastr::success('Customer ' .$request->name. ' update successfully','Success');
                return redirect(route('customer'));
            }
        } catch (\Exception $e) {
            // Toastr::error($e->getMessage(),'Something Wrong');
            Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\res_customer  $res_customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(res_customer $res_customer)
    {
        $customer = res_customer::where('id',$res_customer->id);
        $customer->delete();
        $message="Customer data with name '$res_customer->id' Has been Delete successfully " ;
        return redirect('/customer')->with('status', $message);
    }

    public function searchapi(Request $request)
    {
        $customer = res_customer::where('id', $request->id)->first();
        if ($customer) {
            return response()->json([
                'status' => 'success',
                'data' => $customer
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }

    public function fetchCustomer()
    {
        $customer = res_customer::with('currency','country')->orderBy('name', 'ASC')->get();
        if ($customer) {
            return response()->json([
                'status' => 'success',
                'result' => $customer
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'result' => []
        ]);
    }

    public function fetchCompany()
    {
        $customer = res_customer::with('currency','country')->where('title','company')->orderBy('name', 'ASC')->get();
        if ($customer) {
            return response()->json([
                'status' => 'success',
                'result' => $customer
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'result' => []
        ]);
    }
}
