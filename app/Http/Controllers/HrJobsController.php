<?php

namespace App\Http\Controllers;

use App\Models\Human_Resource\hr_job;
use App\Models\Human_Resource\hr_department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;

class HrJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $jobs = hr_job::orderby('jobs_name','ASC')->paginate(15);
        return view('jobs.index',compact('access','group','jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $departments = hr_department::orderBy('department_name', 'ASC')->get();
        return view('jobs.create',compact('access','group','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'jobs_name' => 'required',
         ]);
         $jobs = new hr_job();
         $jobs -> jobs_name = $request -> jobs_name;
         $jobs -> department_id = $request -> department_id;
         $jobs -> note = $request -> note;
         $jobs -> save();
         return redirect(route('jobs'))
                ->with(['success' => 'jobs <strong>' .$request->name. '</strong> successfully added!']);
    }

    public function edit($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $departments = hr_department::orderBy('department_name', 'ASC')->get();
        $jobs = hr_job::find($id);
        return view('jobs.edit',compact('access','group','jobs','departments'));
    }

    public function update(Request $request,$id)
    {
        $request -> validate([
            'jobs_name' => 'required',
         ]);
         $jobs = hr_job::find($id);
         $jobs -> jobs_name = $request -> jobs_name;
         $jobs -> department_id = $request -> department_id;
         $jobs -> note = $request -> note;
         $jobs -> save();
         return redirect(route('jobs'))
                ->with(['success' => 'jobs successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hr_job  $hr_job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobs = hr_job::find($id);
        $jobs -> delete();
        return redirect(route('jobs'))
                ->with(['success' => 'jobs successfully deleted!']);
    }
}
