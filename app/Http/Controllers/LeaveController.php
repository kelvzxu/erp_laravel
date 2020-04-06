<?php

namespace App\Http\Controllers;

use App\Models\Human_Resource\leave;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::join('users', 'leaves.user_id', '=', 'users.id')
        ->select('leaves.*', 'users.name')
        ->orderBy('created_at', 'desc')
        ->paginate(15);
        return view('leave.index',compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
        echo "$key $value";
        if ($key!=""){
            $leaves = Leave::join('users', 'leaves.user_id', '=', 'users.id')
                            ->select('leaves.*', 'users.name')
                            ->orderBy('created_at', 'desc')
                            ->where($key,'like',"%".$value."%")
                            ->paginate(15);
            $leaves->appends(['filter' => $key ,'value' => $value,'submit' => 'Submit' ])->links();
        }else{
            $leaves = Leave::join('users', 'leaves.user_id', '=', 'users.id')
                            ->select('leaves.*', 'users.name')
                            ->orderBy('created_at', 'desc')
                            ->paginate(15);
        }
        return view('leave.index',compact('leaves'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{ 
            Leave::create([
                'user_id'   => Auth::id(),
                'leave_type'    => $request->leave_type,
                'date_from'     => $request->date_from,
                'date_to'       => $request->date_to,
                'days'          => $request->days,
                'reason'        => $request->reason,
            ]);
            Toastr::success('Leave successfully requested to HR!','Success');
            return redirect()->back();
        }catch (\Exception $e) {
            Toastr::error('Leave requested to HR Error!','Error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(leave $leave)
    {
        //
    }
    public function approve(Request $request,$id)
    {

      //  dd($request->all());
        $leave = Leave::find($id);
//        dd($leave);
       if($leave){
           $leave->is_approved = $request -> approve;
           $leave->save();
           return redirect()->back();
       }
    }

    public function paid(Request $request,$id)
    {
        $leave = Leave::find($id);
        if($leave){
            $leave->leave_type_offer = $request -> paid;
            $leave->save();
            return redirect()->back();
        }
    }
}
