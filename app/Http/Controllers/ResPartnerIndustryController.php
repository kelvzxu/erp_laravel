<?php

namespace App\Http\Controllers;

use App\Models\Data\res_partner_industry;
use Illuminate\Http\Request;

class ResPartnerIndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return res_partner_industry::orderBy('industry_name', 'ASC')->get();
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
     * @param  \App\res_partner_industry  $res_partner_industry
     * @return \Illuminate\Http\Response
     */
    public function show(res_partner_industry $res_partner_industry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\res_partner_industry  $res_partner_industry
     * @return \Illuminate\Http\Response
     */
    public function edit(res_partner_industry $res_partner_industry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\res_partner_industry  $res_partner_industry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, res_partner_industry $res_partner_industry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\res_partner_industry  $res_partner_industry
     * @return \Illuminate\Http\Response
     */
    public function destroy(res_partner_industry $res_partner_industry)
    {
        //
    }
}
