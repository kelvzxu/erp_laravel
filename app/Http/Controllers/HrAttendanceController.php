<?php

namespace App\Http\Controllers;

use App\Models\Human_Resource\hr_attendance;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HrAttendanceController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = hr_attendance::join('users', 'attendance.user_id', '=', 'users.id')
                    ->select('attendance.*', 'users.name')
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
        return view('attendance.index', compact('attendance'));
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
        $attendance = hr_attendance::join('users', 'attendance.user_id', '=', 'users.id')
                    ->select('attendance.*', 'users.name')
                    ->orderBy('created_at', 'desc')
                    ->where([['date', '>', $startDate],['date', '<', $endDate]])
                    ->paginate(1);
        $attendance->appends(['start' => $startDate ,'end' => $endDate,'submit' => 'Submit' ])->links();
        return view('attendance.index', compact('attendance'));
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
            $attendance = hr_attendance::create([
                'user_id'=> $id,
                'date'=> $date,
                'check_in'=> $request->time,
                'check_out'=> $request->time,
            ]);
            Toastr::success('Welcome Check in Date: ' . $date. ' Time :'.$request->time ,'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Check In Error!','Something Wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\hr_attendance  $hr_attendance
     * @return \Illuminate\Http\Response
     */
    public function show(hr_attendance $hr_attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\hr_attendance  $hr_attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(hr_attendance $hr_attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hr_attendance  $hr_attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try {
            $date=date('Y-m-d');
            $attendance = hr_attendance::where('user_id',$id)
                                        ->where('date',$date)
                                        ->update([
                                                    'check_out'=> $request->time,
                                                ]);
            Toastr::success('Goodbye Check in Date: ' . $date. 'Time :'.$request->time ,'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hr_attendance  $hr_attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(hr_attendance $hr_attendance)
    {
        //
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
