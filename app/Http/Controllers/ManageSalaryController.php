<?php

namespace App\Http\Controllers;

use App\Models\Human_Resource\managesalary;
use App\Models\Human_Resource\hr_employee;
use App\Models\Human_Resource\hr_job;
use App\Models\Human_Resource\hr_department;
use App\Models\World_database\res_country;
use App\Models\World_database\res_country_state;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ManageSalaryController extends Controller
{
    public function index()
    {
        $employee = DB::table('hr_employees')
                    ->join('res_country', 'hr_employees.country_id', '=', 'res_country.id')
                    ->join('hr_departments', 'hr_employees.department_id', '=', 'hr_departments.id')
                    ->join('hr_jobs', 'hr_employees.job_id', '=', 'hr_jobs.id')
                    ->select('hr_employees.*', 'res_country.country_name','hr_departments.department_name','hr_jobs.jobs_name')
                    ->paginate(10);
        return view ('payslip.index',compact('employee'));
    }

    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
        echo "$key $value";
        if ($key!=""){
            $employee = DB::table('hr_employees')
                    ->join('res_country', 'hr_employees.country_id', '=', 'res_country.id')
                    ->join('hr_departments', 'hr_employees.department_id', '=', 'hr_departments.id')
                    ->join('hr_jobs', 'hr_employees.job_id', '=', 'hr_jobs.id')
                    ->select('hr_employees.*', 'res_country.country_name','hr_departments.department_name','hr_jobs.jobs_name')
                    ->orderBy('employee_name', 'ASC')
                    ->where($key,'like',"%".$value."%")
                    ->paginate(10);
            $employee ->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
        }else{
            $employee = DB::table('hr_employees')
                    ->join('res_country', 'hr_employees.country_id', '=', 'res_country.id')
                    ->join('hr_departments', 'hr_employees.department_id', '=', 'hr_departments.id')
                    ->join('hr_jobs', 'hr_employees.job_id', '=', 'hr_jobs.id')
                    ->select('hr_employees.*', 'res_country.country_name','hr_departments.department_name','hr_jobs.jobs_name')
                    ->orderBy('employee_name', 'ASC')
                    ->paginate(10);
        }
        return view('payslip.index',compact('employee'));
    }

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
     * @param  \App\manage_salary  $manage_salary
     * @return \Illuminate\Http\Response
     */
    public function show(manage_salary $manage_salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\manage_salary  $manage_salary
     * @return \Illuminate\Http\Response
     */
    public function edit(manage_salary $manage_salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\manage_salary  $manage_salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, manage_salary $manage_salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\manage_salary  $manage_salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(manage_salary $manage_salary)
    {
        //
    }
}
