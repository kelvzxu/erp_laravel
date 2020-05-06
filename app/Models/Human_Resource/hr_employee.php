<?php

namespace App\Models\Human_Resource;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hr_employee extends Model
{
    protected $table = 'hr_employees';
    use softDeletes;
    protected $fillable = [
        'employee_name','work_location',
        'user_id','nationality',
                'identification_id',
                'active',
                'gender',
                'marital',
                'spouse_complete_name',
                'spouse_birthdate',
                'children',
                'place_of_birth',
                'country_of_birth',
                'address',
                'street',
                'zip',
                'city',
                'work_phone',
                'mobile_phonee',
                'work_email',
                'country_id',
                'currency_id',
                'state_id',
                'birthday',
                'ssnid',
                'passport_id',
                'permit_no',
                'visa_no',
                'visa_expire',
                'salary',
                'additional_note',
                'certificate',
                'study_field',
                'study_school',
                'emergency_contact',
                'emergency_phone',
                'bank_account_id',
                'department_id',
                'job_id',
                'photo',
                'parent_id',
                'coach_id'
    ];
}
