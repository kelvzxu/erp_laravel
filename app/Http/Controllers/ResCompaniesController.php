<?php

namespace App\Http\Controllers;

use App\access_right;
use App\User;
use App\Models\Company\res_company;
use App\Models\Currency\res_currency;
use App\Models\World_database\res_country;
use App\Models\World_database\res_country_state;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResCompaniesController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|string|max:50',
        ]);
        try {
            $nama_file="";
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/companies';
                $request->file('photo')->move($destination, $nama_file);
            }
            $data = res_company::create([
                'company_name'=> $request->company_name,
                'display_name'=> $request->company_name,
                'currency_id'=> $request->currency_id,
                'parent_id'=> $request->parent_id,
                'vat'=> $request->vat,
                'email'=> $request->email,
                'Phone'=> $request->Phone,
                'website'=> $request->website,
                'icon'=> $request->icon,
                'photo'=> $nama_file,
                'company_registry'=> $request->company_registry,
                'address'=> $request->address,
                'street'=> $request->street,
                'street2'=> $request->street2,
                'zip'=> $request->zip,
                'city'=> $request->city,
                'state_id'=> $request->state_id,
                'country_id'=> $request->country_id,
                'partner_latitude'=> $request->partner_latitude,
                'partner_longitude'=> $request->partner_longitude,
                'social_twitter'=> $request->social_twitter,
                'social_facebook'=> $request->social_facebook,
                'social_youtube'=> $request->social_youtube,
                'social_instagram'=> $request->social_instagram,
                'social_github'=> $request->social_github,
                'social_linkedin'=> $request->social_linkedin,
            ]);

            Toastr::success('Company ' .$request->name. ' created successfully','Success');
            return redirect(route('companies.index'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\res_company  $res_company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $data = res_company::with('state','country','currency',)->find($id);
        return view('companies.view', compact('access','group','data'));
    }

    public function edit($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $data = res_company::find($id);
        $parent = res_company::orderBy('company_name')->get();
        $country=res_country::orderBy('country_name', 'ASC')->get();
        $state=res_country_state::orderBy('state_name', 'ASC')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        return view('companies.edit', compact('access','group','data','parent','country','state','currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\res_company  $res_company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, res_company $res_company)
    {
        $this->validate($request, [
            'company_name' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        try {

            $data = res_company::where('id',$request->id)->first();
            $nama_file=$data->photo;
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/companies';
                $request->file('photo')->move($destination, $nama_file);
            }

            $data->update([
                'company_name'=> $request->company_name,
                'display_name'=> $request->company_name,
                'currency_id'=> $request->currency_id,
                'parent_id'=> $request->parent_id,
                'vat'=> $request->vat,
                'email'=> $request->email,
                'Phone'=> $request->Phone,
                'website'=> $request->website,
                'icon'=> $request->icon,
                'photo'=> $nama_file,
                'company_registry'=> $request->company_registry,
                'address'=> $request->address,
                'street'=> $request->street,
                'street2'=> $request->street2,
                'zip'=> $request->zip,
                'city'=> $request->city,
                'state_id'=> $request->state_id,
                'country_id'=> $request->country_id,
                'partner_latitude'=> $request->partner_latitude,
                'partner_longitude'=> $request->partner_longitude,
                'social_twitter'=> $request->social_twitter,
                'social_facebook'=> $request->social_facebook,
                'social_youtube'=> $request->social_youtube,
                'social_instagram'=> $request->social_instagram,
                'social_github'=> $request->social_github,
                'social_linkedin'=> $request->social_linkedin,
                'tax_id'=> $request->tax_id,
                'bank_account'=> $request->bank_account,
                'bank_account2'=> $request->bank_account2,
            ]);

            Toastr::success('Company ' .$request->company_name. ' updated successfully','Success');
            return redirect(route('companies.index'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function Companies()
    {
        try {
            $products = res_company::with('currency')->get();
            return response()->json([
                'status' => 'success',
                'data' => $products
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'data' => []
            ]);
        }
    }
}
