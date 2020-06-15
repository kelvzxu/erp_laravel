<?php

namespace App\Http\Controllers;

use App\access_right;
use App\User;
use App\Models\Accounting\account_journal;
use App\Models\Customer\res_customer;
use App\Models\Currency\res_currency;
use App\Models\Data\res_partner_industry;
use App\Models\Data\res_lang;
use App\Models\Data\timezone;
use App\Models\Human_Resource\hr_employee;
use App\Models\Sales\Invoice;
use App\Models\World_database\res_country;
use App\Models\World_database\res_country_state;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResCustomersController extends Controller
{
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $customer = DB::table('res_customers')
                    ->join('res_country', 'res_customers.country_id', '=', 'res_country.id')
                    ->select('res_customers.*', 'res_country.country_name')
                    ->whereNull('res_customers.deleted_at')
                    ->orderBy('name', 'ASC')
                    ->paginate(30);
        return view('res_customer.index',compact('access','group','customer'));
    }

    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
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
        return view('res_customer.index',compact('access','group','customer'));
    }
    
    public function create()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $employee = hr_employee::orderBy('employee_name', 'ASC')->get();
        $account = account_journal::orderBy('code','asc')->get();
        return view('res_customer.create_customer',
            compact('access','group','account','employee'));
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
                'credit_limit'=> "0",
                'debit_limit'=> "0",
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
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $employee = hr_employee::orderBy('employee_name', 'ASC')->get();
        $account = account_journal::orderBy('code','asc')->get();
        $country=res_country::orderBy('country_name', 'ASC')->get();
        $state=res_country_state::orderBy('state_name', 'ASC')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        $lang = res_lang::orderBy('lang_name', 'ASC')->get();
        $tz = timezone::orderBy('timezone', 'ASC')->get();
        $industry= res_partner_industry::orderBy('industry_name', 'ASC')->get();
        $invoice=Invoice::where('client',$res_customer->id)->count();
        return view('res_customer.edit_customer',
            compact('access','group','res_customer','invoice','country','state','currency','lang','tz','industry','employee','account'));
    }

    /**
     * Show the form for editing the specified resource. 
     *
     * @param  \App\res_customer  $res_customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $customer = res_customer::findOrFail($id);
        return view('res_customer.edit_customer', compact('access','group','customer'));
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
        $this->validate($request, [
            'id' => 'required'
        ]);

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
}
