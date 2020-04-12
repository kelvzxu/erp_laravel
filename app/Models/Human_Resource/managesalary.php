<?php

namespace App\Models\Human_Resource;

use Illuminate\Database\Eloquent\Model;

class managesalary extends Model
{
    protected $fillable = [
        'payslip_no',
        'employee_id',
        'designation_type',
        'salary',
        'date_from',
        'date_to',
        'working_days',
        'leave_days',
        'tax',
        'gross_salary'
    ];
}
