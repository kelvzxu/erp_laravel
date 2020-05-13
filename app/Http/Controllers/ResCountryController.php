<?php

namespace App\Http\Controllers;

use App\Models\World_database\res_country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;

class ResCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return res_country::orderBy('country_name', 'ASC')->get();
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
     * @param  \App\res_country  $res_country
     * @return \Illuminate\Http\Response
     */
    public function show(res_country $res_country)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\res_country  $res_country
     * @return \Illuminate\Http\Response
     */
    public function edit(res_country $res_country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\res_country  $res_country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, res_country $res_country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\res_country  $res_country
     * @return \Illuminate\Http\Response
     */
    public function destroy(res_country $res_country)
    {
        //
    }
    public function view()
    {
        // echo("ok");
        // return res_country::all();
    }
}
