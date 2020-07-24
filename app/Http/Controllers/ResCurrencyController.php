<?php

namespace App\Http\Controllers;

use App\Models\Currency\res_currency;
use Illuminate\Http\Request;

class ResCurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return res_currency::orderBy('currency_name', 'ASC')->where('active',true)->get();
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
     * @param  \App\res_currency  $res_currency
     * @return \Illuminate\Http\Response
     */
    public function show(res_currency $res_currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\res_currency  $res_currency
     * @return \Illuminate\Http\Response
     */
    public function edit(res_currency $res_currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\res_currency  $res_currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, res_currency $res_currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\res_currency  $res_currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(res_currency $res_currency)
    {
        //
    }
}
