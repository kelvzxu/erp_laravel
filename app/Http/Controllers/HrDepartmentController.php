<?php

namespace App\Http\Controllers;

use App\Models\Human_Resource\hr_department;
use App\Models\Human_Resource\hr_employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;

class HrDepartmentController extends Controller
{
    public function index()
    { 
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $department = hr_department::with('manager')->orderBy('department_name', 'asc')->paginate(25);
        return view('department.index',compact('access','group','department'));
    }

    public function create()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $departments = hr_department::orderBy('department_name', 'ASC')->get();
        $employee = hr_employee::orderBy('employee_name', 'ASC')->get();
        return view('department.create',compact('access','group','departments','employee'));
    }

    public function store(Request $request)
    {
        $request -> validate([
            'department_name' => 'required',
         ]);
         $department = new hr_department();
         $department -> department_name = $request -> department_name;
         $department -> complete_name = $request -> complete_name;
         $department -> parent_id = $request -> parent_id;
         $department -> manager_id = $request -> manager_id;
         $department -> note = $request -> note;
         $department -> save();
         return redirect(route('department'))
                ->with(['success' => 'Department <strong>' .$request->name. '</strong> successfully added!']);

    }

    public function edit($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $departments = hr_department::orderBy('department_name', 'ASC')->get();
        $employee = hr_employee::orderBy('employee_name', 'ASC')->get();
        $department = hr_department::find($id);
        return view('department.edit',compact('access','group','department','departments','employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hr_department  $hr_department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request -> validate([
            'department_name' => 'required',
         ]);
         $department = hr_department::find($id);
         $department -> department_name = $request -> department_name;
         $department -> complete_name = $request -> complete_name;
         $department -> parent_id = $request -> parent_id;
         $department -> manager_id = $request -> manager_id;
         $department -> note = $request -> note;
         $department -> save();
         return redirect(route('department'))
                ->with(['success' => 'Department successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hr_department  $hr_department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = hr_department::find($id);
        $department -> delete();
        return redirect(route('department'))
                ->with(['success' => 'Department successfully deleted!']);
    }
}
