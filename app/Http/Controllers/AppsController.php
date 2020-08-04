<?php

namespace App\Http\Controllers;

use App\access_right;
use App\Models\Apps\ir_model;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Addons;

class AppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $data = ir_model::where('state','base')->orderBy('name', 'ASC')->paginate(30);
        return view('Apps.index', compact('access','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function install($id)
    {
        try{
            $data = ir_model::where('model',$id)->first();
            $data->technical_name::installed();
            $data->update([
                'instalation'=> True,
            ]);
            Toastr::success('Module '.$data->name.' successfully installed','Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(),'Something Wrong');
            // Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function check_installed($request)
    {
        $response = Addons::cek_install_modules($request);
        
        return response()->json([
            'status' => 'success',
            'result' => $response,
        ], 200);
    }
}
