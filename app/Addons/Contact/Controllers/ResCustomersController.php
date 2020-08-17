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
            $data = $request->all();
            $data['display_name'] = $display_name;
            $data['logo'] = $imageName;

            res_customer::create($data);
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
            if (!empty($partner->logo)) {
                File::delete(public_path('uploads/Customers/' . $partner->logo));
            }
        }

        if ($request->parent_id != null){
            $display_name = $this->prepare_display_name($request->parent_id, $display_name);
        }

        try{
            $data = $request->all();
            $data['display_name'] = $display_name;
            $data['logo'] = $imageName;

            $partner->update($data);

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
