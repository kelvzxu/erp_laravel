<?php

namespace App\Http\Controllers;

use App\Models\Human_Resource\hr_attendance;
use App\Models\Human_Resource\hr_employee;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\access_right;
use App\User;

class HrAttendanceController extends Controller
{
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $attendance = hr_attendance::join('users', 'attendance.user_id', '=', 'users.id')
                    ->select('attendance.*', 'users.name')
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
        return view('attendance.index', compact('access','group','attendance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $startDate=$request->start;
        $endDate=$request->end;
        $name = $request->value;
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        if($startDate!=""||$endDate!="" ){
            $attendance = hr_attendance::join('users', 'attendance.user_id', '=', 'users.id')
                        ->select('attendance.*', 'users.name')
                        ->orderBy('created_at', 'desc')
                        ->where([['date', '>', $startDate],['date', '<', $endDate]])
                        ->paginate(31);
            $attendance->appends(['start' => $startDate ,'end' => $endDate,'submit' => 'Submit' ])->links();
        }
        else if($name !=""){
            $attendance = hr_attendance::join('users', 'attendance.user_id', '=', 'users.id')
                        ->select('attendance.*', 'users.name')
                        ->orderBy('created_at', 'desc')
                        ->where('users.name','like',"%".$name."%")
                        ->paginate(31);
            $attendance->appends(['name' => $name ,'submit' => 'Submit' ])->links();
        }
        return view('attendance.index', compact('access','group','attendance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        try {
            $date=date('Y-m-d');
            $user = User::find($id);
            $name = $user->name;
            $attendance = hr_attendance::create([
                'user_id'=> $id,
                'date'=> $date,
                'check_in'=> $request->time,
            ]);
            $employee = hr_employee::where('user_id',$id)->update([
                'active'=> True,
            ]);
            Toastr::success('Welcome '.$name.' <br> Check in Date: ' . $date. ' Time :'.$request->time ,'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $date=date('Y-m-d');
            $user = User::find($id);
            $name = $user->name;
            $attendance = hr_attendance::where('user_id',$id)
                                        ->where('date',$date)
                                        ->update([
                                                    'check_out'=> $request->time,
                                                ]);
            $employee = hr_employee::where('user_id',$id)->update([
                'active'=> False,
            ]);
            Toastr::success('Goodbye '.$name.' <br> Check out Date: ' . $date. ' Time :'.$request->time ,'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function checkatd(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);

        $date=date('Y-m-d');
        $attendance = hr_attendance::all()->where('user_id',$request->id)->where('date',$date)->count();
        if ($attendance) {
            return response()->json([
                'status' => 'success',
                'data' => $attendance
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }
    public function getcount(Request $request){
        $startDate=$request->start;
        $endDate=$request->end;
        $attendance = hr_attendance::where([['user_id',$request->id],['date', '>', $startDate],['date', '<', $endDate]])->count();
        if ($attendance) {
            return response()->json([
                'status' => 'success',
                'data' => $attendance
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }
}
