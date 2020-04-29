<?php

namespace App\Http\Controllers;

use App\Models\Human_Resource\hr_attendance;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HrRecruitmentController extends Controller
{
    public function index()
    {
        return view('Recruitment.index');
    }
}
