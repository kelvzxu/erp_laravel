<?php

namespace App\Http\Controllers;

use App\Models\World_database\res_country_state;
use Illuminate\Http\Request;
use Response;

class ResCountryStatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return res_country_state::orderBy('state_name', 'ASC')->get();
    }
    public function search(Request $request){
        $data = $request->get('data');

        $state = res_country_state::where('country_id',$data)
                         ->get();

        return Response::json([
            'data' => $state
        ]);   
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
     * @param  \App\res_country_state  $res_country_state
     * @return \Illuminate\Http\Response
     */
    public function show(res_country_state $res_country_state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\res_country_state  $res_country_state
     * @return \Illuminate\Http\Response
     */
    public function edit(res_country_state $res_country_state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\res_country_state  $res_country_state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, res_country_state $res_country_state)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\res_country_state  $res_country_state
     * @return \Illuminate\Http\Response
     */
    public function destroy(res_country_state $res_country_state)
    {
        //
    }
}
