<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Human_Resource\hr_employee;
use App\Models\Human_Resource\hr_job;
use App\Models\Human_Resource\hr_department;
use App\Models\World_database\res_country;
use App\Models\World_database\res_country_state;
use App\Models\Currency\res_currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HrEmployeesController extends Controller
{
    public function index()
    {
        $employee = DB::table('hr_employees')
                    ->join('res_country', 'hr_employees.country_id', '=', 'res_country.id')
                    ->join('hr_departments', 'hr_employees.department_id', '=', 'hr_departments.id')
                    ->join('hr_jobs', 'hr_employees.job_id', '=', 'hr_jobs.id')
                    ->select('hr_employees.*', 'res_country.country_name','hr_departments.department_name')
                    ->whereNull('hr_employees.deleted_at')
                    ->orderBy('employee_name', 'ASC')
                    ->paginate(10);
        return view ('hr_employee.index',compact('employee'));
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
        return view('hr_employee.index',compact('employee'));
    }

    public function create()
    {
        $departments = hr_department::orderBy('department_name', 'ASC')->get();
        $jobs = hr_job::orderBy('jobs_name', 'ASC')->get();
        $country=res_country::orderBy('country_name', 'ASC')->get();
        $state=res_country_state::orderBy('state_name', 'ASC')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        $employee = hr_employee::orderBy('employee_name', 'ASC')->get();
        return view('hr_employee.create',
                compact('departments','jobs','country','state','currency','employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:products',
            'work_email' => 'required|min:5|email',
            'password' => 'required|string|confirmed',
            'identification_id' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'country' => 'required|integer',
            'work_phone'=> 'required',
            'emergency_contact'=> 'required',
            'emergency_phone' => 'required',
            'country_of_birth' => 'required|integer',
        ]);
        try {
            $nama_file="";
            $photo = null;
            if ($request->hasFile('image')) {
                $photo = $request->file('image')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/Employees';
                $request->file('image')->move($destination, $nama_file);
            }
            // crete user 
            User::create([
                'name' => $request->name,
                'email'=>$request->work_email,
                'password'=>Hash::make($request->password),
                'status' => True,
            ]);
            // select id user
            $user = User::where('email', $request->work_email)->first();
            $id =$user->id;
            // create employee
            $employee = hr_employee::create([
                'user_id'=> $user->id,
                'employee_name'=> $request->name,
                'identification_id'=> $request->identification_id,
                'active'=> True,
                'gender'=> $request->gender,
                'marital'=> $request->marital,
                'spouse_complete_name'=> $request->spouse_complete_name,
                'spouse_birthdate'=> $request->spouse_birthdate,
                'children'=> $request->children,
                'place_of_birth'=> $request->place_of_birth,
                'country_of_birth'=> $request->country_of_birth,
                'address'=> $request->address,
                'street'=> $request->street1,
                'zip'=> $request->zip,
                'city'=> $request->city,
                'work_phone'=> $request->work_phone,
                'mobile_phonee'=> $request->work_mobile,
                'work_email'=> $request->work_email,
                'country_id'=> $request->country,
                'currency_id'=> $request->currency_id,
                'state_id'=> $request->state,
                'birthday'=> $request->birthday,
                'ssnid'=> $request->ssnid,
                'passport_id'=> $request->passport_id,
                'permit_no'=> $request->permit_no,
                'visa_no'=> $request->visa_no,
                'visa_expire'=> $request->visa_expire,
                'salary'=> $request->salary,
                'additional_note'=> $request->name,
                'certificate'=> $request->certificate,
                'study_field'=> $request->study_field,
                'study_school'=> $request->study_school,
                'emergency_contact'=> $request->emergency_contact,
                'emergency_phone'=> $request->emergency_phone,
                'bank_account_id'=> $request->Bank_account_id,
                'department_id'=> $request->department,
                'job_id'=> $request->jobs,
                'photo'=> $nama_file,
                'parent_id'=> $request->parent_id,
                'coach_id'=> $request->coach_id,
            ]);
            return redirect(route('employee'))
                ->with(['success' => 'employee ' .$request->name. '> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
            // ->with(['error' => 'Terjadi Kesalahan saat Menyimpan data']);
            ->with(['error' => $e->getMessage()]);
        }
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
        $departments = hr_department::orderBy('department_name', 'ASC')->get();
        $jobs = hr_job::orderBy('jobs_name', 'ASC')->get();
        $country=res_country::orderBy('country_name', 'ASC')->get();
        $state=res_country_state::orderBy('state_name', 'ASC')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        $employee = hr_employee::orderBy('employee_name', 'ASC')->get();
        return view('hr_employee.edit',
                compact('hr_employee','departments','jobs','country','state','currency','employee'));
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
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:products',
            'work_email' => 'required|email',
            'identification_id' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'country' => 'required|integer',
            'work_phone'=> 'required',
            'emergency_contact'=> 'required',
            'emergency_phone' => 'required',
            'country_of_birth' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);
        try {
            $nama_file="";
            $photo = null;
            if ($request->hasFile('image')) {
                $photo = $request->file('image')->getClientOriginalName();
                $nama_file = time()."_".$photo;
                $destination = base_path() . '/public/uploads/Employees';
                $request->file('image')->move($destination, $nama_file);

                $employee = hr_employee::where('id',$request->id)->update([
                    'employee_name'=> $request->name,
                    'identification_id'=> $request->identification_id,
                    'active'=> True,
                    'gender'=> $request->gender,
                    'marital'=> $request->marital,
                    'spouse_complete_name'=> $request->spouse_complete_name,
                    'spouse_birthdate'=> $request->spouse_birthdate,
                    'children'=> $request->children,
                    'place_of_birth'=> $request->place_of_birth,
                    'country_of_birth'=> $request->country_of_birth,
                    'address'=> $request->address,
                    'street'=> $request->street1,
                    'zip'=> $request->zip,
                    'city'=> $request->city,
                    'work_phone'=> $request->work_phone,
                    'mobile_phonee'=> $request->work_mobile,
                    'work_email'=> $request->work_email,
                    'country_id'=> $request->country,
                    'currency_id'=> $request->currency_id,
                    'state_id'=> $request->state,
                    'birthday'=> $request->birthday,
                    'ssnid'=> $request->ssnid,
                    'passport_id'=> $request->passport_id,
                    'permit_no'=> $request->permit_no,
                    'visa_no'=> $request->visa_no,
                    'visa_expire'=> $request->visa_expire,
                    'salary'=> $request->salary,
                    'additional_note'=> $request->name,
                    'certificate'=> $request->certificate,
                    'study_field'=> $request->study_field,
                    'study_school'=> $request->study_school,
                    'emergency_contact'=> $request->emergency_contact,
                    'emergency_phone'=> $request->emergency_phone,
                    'bank_account_id'=> $request->Bank_account_id,
                    'department_id'=> $request->department,
                    'job_id'=> $request->jobs,
                    'photo'=> $nama_file,
                    'parent_id'=> $request->parent_id,
                    'coach_id'=> $request->coach_id,
                    ]);
                return redirect(route('employee'))
                    ->with(['success' => 'employee <strong>' .$request->name. '</strong> successfully updated!']);
            }
            else{
                $employee = hr_employee::where('id',$request->id)->update([
                    'employee_name'=> $request->name,
                    'identification_id'=> $request->identification_id,
                    'active'=> True,
                    'gender'=> $request->gender,
                    'marital'=> $request->marital,
                    'spouse_complete_name'=> $request->spouse_complete_name,
                    'spouse_birthdate'=> $request->spouse_birthdate,
                    'children'=> $request->children,
                    'place_of_birth'=> $request->place_of_birth,
                    'country_of_birth'=> $request->country_of_birth,
                    'address'=> $request->address,
                    'street'=> $request->street1,
                    'zip'=> $request->zip,
                    'city'=> $request->city,
                    'work_phone'=> $request->work_phone,
                    'mobile_phonee'=> $request->work_mobile,
                    'work_email'=> $request->work_email,
                    'country_id'=> $request->country,
                    'currency_id'=> $request->currency_id,
                    'state_id'=> $request->state,
                    'birthday'=> $request->birthday,
                    'ssnid'=> $request->ssnid,
                    'passport_id'=> $request->passport_id,
                    'permit_no'=> $request->permit_no,
                    'visa_no'=> $request->visa_no,
                    'visa_expire'=> $request->visa_expire,
                    'salary'=> $request->salary,
                    'additional_note'=> $request->name,
                    'certificate'=> $request->certificate,
                    'study_field'=> $request->study_field,
                    'study_school'=> $request->study_school,
                    'emergency_contact'=> $request->emergency_contact,
                    'emergency_phone'=> $request->emergency_phone,
                    'bank_account_id'=> $request->Bank_account_id,
                    'department_id'=> $request->department,
                    'job_id'=> $request->jobs,
                    'parent_id'=> $request->parent_id,
                    'coach_id'=> $request->coach_id,
                    ]);
                return redirect(route('employee'))
                    ->with(['success' => 'employee <strong>' .$request->name. '</strong> successfully updated!']);
            }
        } catch (\Exception $e) {
            return redirect()->back()
            // ->with(['error' => 'Terjadi Kesalahan saat Menyimpan data']);
            ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hr_employee  $hr_employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = hr_employee::find($id);
        $employee -> delete();
        return redirect(route('employee'))
                ->with(['success' => 'employee successfully deleted!']);
    }

    public function searchapi(Request $request)
    {
        $this->validate($request, [
            'email' => 'required'
        ]);

        $employee = hr_employee::join('res_country', 'hr_employees.country_id', '=', 'res_country.id')
                                ->join('hr_departments', 'hr_employees.department_id', '=', 'hr_departments.id')
                                ->join('hr_jobs', 'hr_employees.job_id', '=', 'hr_jobs.id')
                                ->select('hr_employees.*', 'res_country.country_name','hr_departments.department_name','hr_jobs.jobs_name')
                                ->where('hr_employees.work_email',$request->email)->first();
        // $employee = hr_employee::where('work_email', $request->email)->first();
        if ($employee) {
            return response()->json([
                'status' => 'success',
                'data' => $employee
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }
}
