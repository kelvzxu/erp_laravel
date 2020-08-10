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
use File;

class ResCustomersController extends Controller
{
    function UploadFile($name, $photo)
    {
        $extension = explode('/', explode(':', substr($photo, 0, strpos($photo, ';')))[1])[1];
        $replace = substr($photo, 0, strpos($photo, ',')+1); 
        $image = str_replace($replace, '', $photo); 
        $image = str_replace(' ', '+', $image); 
        $imageName = time() .'_'.str_replace(' ','_',$name).'.'.$extension;
        $path = public_path('uploads/Customers');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        file_put_contents(public_path('uploads/Customers/').$imageName,base64_decode($image));
        return $imageName;
    }

    function prepare_display_name($value, $name){
        $data = res_customer::findorFail($value);
        $display_name = "$data->display_name , $name";
        return $display_name;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'currency_id' =>'required'
        ]);

        $image_64 = $request->photo;
        $imageName = null;
        $display_name = $request->name;
        if ($image_64 != ""){
            $imageName = $this->UploadFile($request->name,$image_64);
        }

        if ($request->parent_id != null){
            $display_name = $this->prepare_display_name($request->parent_id, $display_name);
        }

        try{
            res_customer::create([
                'name'=> $request->name,
                'display_name'=> $display_name,
                'parent_id'=> $request->parent_id,
                'ref'=> $request->ref,
                'lag'=> $request->lag,
                'tz'=> $request->tz,
                'currency_id'=> $request->currency_id,
                'website'=> $request->website,
                'active'=> $active=True,
                'address'=> $request->address,
                'street'=> $request->street,
                'street2'=> $request->street2,
                'zip'=> $request->zip,
                'city'=> $request->city,
                'state_id'=> $request->state_id,
                'country_id'=> $request->country_id,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'mobile'=> $request->mobile,
                'industry_id'=> $request->industry_id,
                'sales'=> $request->sales,
                'payment_terms'=>$request->payment_terms,
                'note'=>$request->note,
                'logo'=> $imageName,
                'vat'=>$request->vat,
                'blocking_stage'=>$request->blocking_stage,
                'warning_stage'=>$request->warning_stage,
                'title'=>$request->title,
                'company_id'=>$request->company_id,
                'job_title'=>$request->job_title,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Partner $request->name ($display_name) Created Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'currency_id' =>'required'
        ]);

        $partner = res_customer::findorFail($request->id);
        $image_64 = $request->photo;
        $imageName = $partner->logo;
        $display_name = $request->name;
        if ($image_64 != ""){
            $imageName = $this->UploadFile($request->name,$image_64);
        }

        if ($request->parent_id != null){
            $display_name = $this->prepare_display_name($request->parent_id, $display_name);
        }

        try{
            res_customer::findOrFail($request->id)->update([
                'name'=> $request->name,
                'display_name'=> $display_name,
                'parent_id'=> $request->parent_id,
                'ref'=> $request->ref,
                'lag'=> $request->lag,
                'tz'=> $request->tz,
                'currency_id'=> $request->currency_id,
                'website'=> $request->website,
                'active'=> $active=True,
                'address'=> $request->address,
                'street'=> $request->street,
                'street2'=> $request->street2,
                'zip'=> $request->zip,
                'city'=> $request->city,
                'state_id'=> $request->state_id,
                'country_id'=> $request->country_id,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'mobile'=> $request->mobile,
                'industry_id'=> $request->industry_id,
                'sales'=> $request->sales,
                'payment_terms'=>$request->payment_terms,
                'note'=>$request->note,
                'logo'=> $imageName,
                'vat'=>$request->vat,
                'blocking_stage'=>$request->blocking_stage,
                'warning_stage'=>$request->warning_stage,
                'title'=>$request->title,
                'company_id'=>$request->company_id,
                'job_title'=>$request->job_title,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Partner $request->name ($display_name) Update Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
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
        $customer = res_customer::with('currency','country','parent')->where('id', $request->id)->first();
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
        $customer = res_customer::with('currency','country','parent','industry')->orderBy('name', 'ASC')->get();
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
        $customer = res_customer::with('currency','country','parent')->where('title','company')->orderBy('name', 'ASC')->get();
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
