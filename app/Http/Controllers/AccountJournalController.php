<?php

namespace App\Http\Controllers;

use App\Models\Accounting\account_journal;
use Illuminate\Http\Request;

class AccountJournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\account_journal  $account_journal
     * @return \Illuminate\Http\Response
     */
    public function show(account_journal $account_journal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\account_journal  $account_journal
     * @return \Illuminate\Http\Response
     */
    public function edit(account_journal $account_journal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\account_journal  $account_journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, account_journal $account_journal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\account_journal  $account_journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(account_journal $account_journal)
    {
        //
    }
}
