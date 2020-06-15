<?php

namespace App\Http\Controllers;

use App\Models\Human_Resource\leave;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\access_right;
use App\User;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $leaves = Leave::join('users', 'leaves.user_id', '=', 'users.id')
        ->select('leaves.*', 'users.name')
        ->orderBy('created_at', 'desc')
        ->paginate(15);
        return view('leave.index',compact('access','group','leaves'));
    }

    public function search(Request $request)
    {
        $key=$request->filter;
        $value=$request->value;
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
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
        return view('leave.index',compact('access','group','leaves'));
    }

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
    
    public function getcount(Request $request){
        $startDate=$request->start;
        $endDate=$request->end;
        $leaves = Leave::where([['user_id',$request->id],['is_approved',1],['date_from', '>', $startDate],['date_from', '<', $endDate]]);
        if ($leaves) {
            return response()->json([
                'status' => 'success',
                'data' => $leaves
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'data' => []
        ]);
    }
}
