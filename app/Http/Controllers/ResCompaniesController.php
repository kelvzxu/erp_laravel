<?php

namespace App\Http\Controllers;

use App\Models\Company\res_company;
use Illuminate\Http\Request;
use File;

class ResCompaniesController extends Controller
{
    function UploadFile($name, $photo)
    {
        $extension = explode('/', explode(':', substr($photo, 0, strpos($photo, ';')))[1])[1];
        $replace = substr($photo, 0, strpos($photo, ',')+1); 
        $image = str_replace($replace, '', $photo); 
        $image = str_replace(' ', '+', $image); 
        $imageName = time() .'_'.str_replace(' ','_',$name).'.'.$extension;
        $path = public_path('uploads/Company');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        file_put_contents(public_path('uploads/Company/').$imageName,base64_decode($image));
        return $imageName;
    }

    public function CountCompanies(){
        try {
            $response = res_company::count();
            return response()->json([
                'status' => 'success',
                'result' => $response
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'result' => []
            ]);
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|string|max:50',
            'currency_id' =>'required'
        ]);

        $image_64 = $request->photo;
        $imageName = null;
        $display_name = $request->company_name;
        if ($image_64 != null){
            $imageName = $this->UploadFile($request->company_name,$image_64);
        }

        try{
            $data = $request->all();
            $data['display_name'] = $display_name;
            $data['photo'] = $imageName;

            res_company::create($data);
            
            return response()->json([
                'status' => 'success',
                'message' => "Company $request->company_name Created Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
