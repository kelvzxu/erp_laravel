<?php
namespace App\Helpers;

use App\Models\Human_Resource\hr_employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HumanResource {
    public static function employee() {
        $employee = hr_employee::orderBy('employee_name', 'ASC')->get();
        return $employee;
    }
}