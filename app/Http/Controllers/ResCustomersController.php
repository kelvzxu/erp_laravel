<?php

namespace App\Http\Controllers;

use App\Models\Customer\res_customer;
use App\Models\World_database\res_country;
use App\Models\World_database\res_country_state;
use App\Models\Data\res_partner_industry;
use App\Models\Currency\res_currency;
use App\Models\Data\res_lang;
use App\Models\Data\timezone;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ResCustomersController extends Controller
{
    public function index()
    {
        $customer = DB::table('res_customers')
                    ->join('res_country', 'res_customers.country_id', '=', 'res_country.id')
                    ->select('res_customers.*', 'res_country.country_name')
                    ->whereNull('res_customers.deleted_at')
                    ->orderBy('name', 'ASC')
                    ->paginate(10);
        return view('res_customer.index',compact('customer'));
    }

    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
        echo "$key $value";
        if ($key!=""){
            $customer = DB::table('res_customers')
                    ->join('res_country', 'res_customers.country_id', '=', 'res_country.id')
                    ->select('res_customers.*', 'res_country.country_name')
                    ->whereNull('res_customers.deleted_at')
                    ->orderBy('name', 'ASC')
                    ->where($key,'like',"%".$value."%")
                    ->paginate(10);
            $customer ->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
        }else{
            $customer = DB::table('res_customers')
                    ->join('res_country', 'res_customers.country_id', '=', 'res_country.id')
                    ->select('res_customers.*', 'res_country.country_name')
                    ->whereNull('res_customers.deleted_at')
                    ->orderBy('name', 'ASC')
                    ->paginate(10);
        }
        return view('res_customer.index',compact('customer'));
    }
    public function create()
    {
        return view('res_customer.create_customer');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:products',
            'display_name' => 'required|string|max:50',
            'Parent_id' => 'nullable|string|max:100',
            'industry_id' => 'required|integer',
            'address' => 'required|string',
            'email' => 'nullable|string|max:100',
            'street1' => 'nullable|string|max:100',
            'street2' => 'nullable|string|max:100',
            'mobile' => 'nullable|string|max:100',
            'country' => 'required|integer',
            'currency_id' => 'required|integer',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        try {
            $nama_file="";
            $photo = null;
            if ($request->hasFile('image')) {
                $photo = $request->file('image')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/customers';
                $request->file('image')->move($destination, $nama_file);
            }

            $res_customer = res_customer::create([
                'name'=> $request->name,
                'display_name'=> $request->display_name,
                'title'=> $request->code,
                'parent_id'=> $request->Parent_id,
                'ref'=> $request->reference,
                'lag'=> $request->lag,
                'tz'=> $request->tz,
                'currency_id'=> $request->currency_id,
                'bank_account'=> $request->bank_account,
                'website'=> $request->website,
                'credit_limit'=> $request->credit,
                'debit_limit'=> $request->debit,
                'active'=> $active=True,
                'address'=> $request->address,
                'street'=> $request->street1,
                'zip'=> $request->zip,
                'city'=> $request->street2,
                'state_id'=> $request->state,
                'country_id'=> $request->country,
                'partner_latitude'=> $request->partner_latitude,
                'partner_longitude'=> $request->partner_longitude,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'mobile'=> $request->mobile,
                'industry_id'=> $request->industry_id,
                'logo'=> $nama_file,
            ]);
            return redirect(route('customer'))
                ->with(['success' => 'Customers <strong>' .$request->name. '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
            // ->with(['error' => 'Terjadi Kesalahan saat Menyimpan data']);
            ->with(['error' => $e->getMessage()]);
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
        $country=res_country::orderBy('country_name', 'ASC')->get();
        $state=res_country_state::orderBy('state_name', 'ASC')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        $lang = res_lang::orderBy('lang_name', 'ASC')->get();
        $tz = timezone::orderBy('timezone', 'ASC')->get();
        $industry= res_partner_industry::orderBy('industry_name', 'ASC')->get();
        return view('res_customer.edit_customer',
            compact('res_customer','country','state','currency','lang','tz','industry'));
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
        // print_r($customer);
        return view('res_customer.edit_customer', compact('customer'));
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
            'name' => 'required|string|max:50|unique:products',
            'display_name' => 'required|string|max:50',
            'Parent_id' => 'nullable|string|max:100',
            'industry_id' => 'required|integer',
            'address' => 'required|string',
            'email' => 'nullable|string|max:100',
            'street1' => 'nullable|string|max:100',
            'street2' => 'nullable|string|max:100',
            'mobile' => 'nullable|string|max:100',
            'country' => 'required|integer',
            'currency_id' => 'required|integer',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        try {
            $nama_file="";
            $photo = null;
            if ($request->hasFile('image')) {
                $photo = $request->file('image')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/customers';
                $request->file('image')->move($destination, $nama_file);

                $res_customer = res_customer::where('id',$request->id)->update([
                    'name'=> $request->name,
                    'display_name'=> $request->display_name,
                    'title'=> $request->code,
                    'parent_id'=> $request->Parent_id,
                    'ref'=> $request->reference,
                    'lag'=> $request->lag,
                    'tz'=> $request->tz,
                    'currency_id'=> $request->currency_id,
                    'bank_account'=> $request->bank_account,
                    'website'=> $request->website,
                    'credit_limit'=> $request->credit,
                    'debit_limit'=> $request->debit,
                    'active'=> $active=True,
                    'address'=> $request->address,
                    'street'=> $request->street1,
                    'zip'=> $request->zip,
                    'city'=> $request->street2,
                    'state_id'=> $request->state,
                    'country_id'=> $request->country,
                    'partner_latitude'=> $request->partner_latitude,
                    'partner_longitude'=> $request->partner_longitude,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                    'mobile'=> $request->mobile,
                    'industry_id'=> $request->industry_id,
                    'logo'=> $nama_file,
                ]);
                return redirect(route('customer'))
                    ->with(['success' => 'Customers <strong>' .$request->name. '</strong> Diubah']);
            }
            else{
                $res_customer = res_customer::where('id',$request->id)->update([
                    'name'=> $request->name,
                    'display_name'=> $request->display_name,
                    'title'=> $request->code,
                    'parent_id'=> $request->Parent_id,
                    'ref'=> $request->reference,
                    'lag'=> $request->lag,
                    'tz'=> $request->tz,
                    'currency_id'=> $request->currency_id,
                    'bank_account'=> $request->bank_account,
                    'website'=> $request->website,
                    'credit_limit'=> $request->credit,
                    'debit_limit'=> $request->debit,
                    'active'=> $active=True,
                    'address'=> $request->address,
                    'street'=> $request->street1,
                    'zip'=> $request->zip,
                    'city'=> $request->street2,
                    'state_id'=> $request->state,
                    'country_id'=> $request->country,
                    'partner_latitude'=> $request->partner_latitude,
                    'partner_longitude'=> $request->partner_longitude,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                    'mobile'=> $request->mobile,
                    'industry_id'=> $request->industry_id,
                ]);
                return redirect(route('customer'))
                    ->with(['success' => 'Customers <strong>' .$request->name. '</strong> Diubah']);
            }
        } catch (\Exception $e) {
            // return redirect()->back()/
            echo $request->parent_id;
            // ->with(['error' => 'Terjadi Kesalahan saat Menyimpan data']);
            // ->with(['error' => $e->getMessage()]);
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
