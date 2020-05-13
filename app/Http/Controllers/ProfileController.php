<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Human_Resource\hr_employee;
use App\Models\Data\res_lang;
use App\Models\Data\timezone;
use App\Models\World_database\res_country;
use App\Models\World_database\res_country_state;
use App\Models\Currency\res_currency;
use App\access_right;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $profile= hr_employee::join('hr_departments', 'hr_employees.department_id', '=', 'hr_departments.id')
                                ->join('hr_jobs', 'hr_employees.job_id', '=', 'hr_jobs.id')
                                ->select('hr_employees.*','hr_departments.department_name','hr_jobs.jobs_name')
                                ->where('user_id',Auth::id())
                                ->first();
        $lang = res_lang::orderBy('lang_name', 'ASC')->get();
        $tz = timezone::orderBy('timezone', 'ASC')->get();
        $country=res_country::orderBy('country_name', 'ASC')->get();
        $state=res_country_state::orderBy('state_name', 'ASC')->get();
        $currency = res_currency::orderBy('currency_name', 'ASC')->get();
        $employee = hr_employee::orderBy('employee_name', 'ASC')->get();
        return view('profile.index',
                compact('access','group','profile','lang','tz','country','state','currency','employee'));
    }

    public function update(Request $request)
    {
        try {
            $nama_file="";
            $photo = null;

            $employee = hr_employee::where('user_id',Auth::id())->update([
                'identification_id'=> $request->identification_id,
                'gender'=> $request->gender,
                'place_of_birth'=> $request->place_of_birth,
                'country_of_birth'=> $request->country_of_birth,
                'work_phone'=> $request->work_phone,
                'mobile_phonee'=> $request->work_mobile,
                'work_email'=> $request->work_email,
                'country_id'=> $request->country,
                'birthday'=> $request->birthday,
                'passport_id'=> $request->passport_id,
                'permit_no'=> $request->permit_no,
                'visa_no'=> $request->visa_no,
                'visa_expire'=> $request->visa_expire,
                'certificate'=> $request->certificate,
                'study_field'=> $request->study_field,
                'study_school'=> $request->study_school,
                'emergency_contact'=> $request->emergency_contact,
                'emergency_phone'=> $request->emergency_phone,
                'work_location'=> $request->work_location,
                ]);
            return redirect(route('employee'))
                ->with(['success' => 'employee <strong>' .$request->name. '</strong> successfully updated!']);
        } catch (\Exception $e) {
            return redirect()->back()
            // ->with(['error' => 'Terjadi Kesalahan saat Menyimpan data']);
            ->with(['error' => $e->getMessage()]);
        }
    }

}
