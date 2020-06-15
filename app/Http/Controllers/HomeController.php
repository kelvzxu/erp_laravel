<?php

namespace App\Http\Controllers;


use App\Models\Human_Resource\hr_attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\access_right;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        if ($group->user_type!=1){
            return redirect()->route('ECommerce.index');
        }
        return view('dashboard', compact('access','group'));
    }
}
