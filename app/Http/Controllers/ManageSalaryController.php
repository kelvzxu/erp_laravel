<?php

namespace App\Http\Controllers;

use App\Models\Human_Resource\managesalary;
use App\Models\Human_Resource\leave;
use App\Models\Human_Resource\hr_employee;
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

    public function create($id)
    {
        $employee = DB::table('hr_employees')
                    ->join('res_country', 'hr_employees.country_id', '=', 'res_country.id')
                    ->join('hr_departments', 'hr_employees.department_id', '=', 'hr_departments.id')
                    ->join('hr_jobs', 'hr_employees.job_id', '=', 'hr_jobs.id')
                    ->select('hr_employees.*', 'res_country.country_name','hr_departments.department_name','hr_jobs.jobs_name')
                    ->where('hr_employees.id',$id)->first();
        return view ('payslip.create',compact('employee'));
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

    public function getcount(Request $request)
    {
        $startDate=$request->start;
        $endDate=$request->end;
        $total_leaves=Leave::all()->where('user_id',$request->id)->where('is_approved',1)->where('date_from', '>',$startDate)->where('date_to', '<',$endDate);
        if ($total_leaves) {
            return response()->json([
                'status' => 'success',
                'data' => $total_leaves
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }
}
