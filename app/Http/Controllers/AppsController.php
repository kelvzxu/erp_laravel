<?php

namespace App\Http\Controllers;

use App\access_right;
use App\Models\Apps\ir_model;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        // try{
            $data = ir_model::where('model',$id)->first();
            $data->update([
                'instalation'=> True,
            ]);
            Toastr::success('Module '.$data->name.' successfully installed','Success');
            return redirect()->back();
        // } catch (\Exception $e) {
        //     Toastr::error($e->getMessage(),'Something Wrong');
        //     // Toastr::error('Check In Error!','Something Wrong');
        //     return redirect()->back();
        // }
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
     * @param  \App\ir_model  $ir_model
     * @return \Illuminate\Http\Response
     */
    public function show(ir_model $ir_model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ir_model  $ir_model
     * @return \Illuminate\Http\Response
     */
    public function edit(ir_model $ir_model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ir_model  $ir_model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ir_model $ir_model)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ir_model  $ir_model
     * @return \Illuminate\Http\Response
     */
    public function destroy(ir_model $ir_model)
    {
        //
    }
}
