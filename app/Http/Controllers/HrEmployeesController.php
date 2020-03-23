<?php

namespace App\Http\Controllers;

use App\Models\Human_Resource\hr_employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HrEmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = DB::table('hr_employees')
                    ->join('res_country_state', 'hr_employees.state_id', '=', 'res_country_state.id')
                    ->select('hr_employees.*', 'res_country_state.state_name')
                    ->paginate(10);
        return view ('hr_employee.index',compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hr_employee.create_employee');
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
     * @param  \App\hr_employee  $hr_employee
     * @return \Illuminate\Http\Response
     */
    public function show(hr_employee $hr_employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\hr_employee  $hr_employee
     * @return \Illuminate\Http\Response
     */
    public function edit(hr_employee $hr_employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hr_employee  $hr_employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hr_employee $hr_employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hr_employee  $hr_employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(hr_employee $hr_employee)
    {
        //
    }
}
