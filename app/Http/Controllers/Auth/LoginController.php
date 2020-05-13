<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password, 'status' => True,'user_type' =>1])) {
            user::where('id',Auth::id())->update([
                'latest_Authentication'=>date('Y-m-d H:i:s'),
            ]);
            return redirect()->intended('/home');
        }
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password, 'status' => True,'user_type' =>2])) {
            user::where('id',Auth::id())->update([
                'latest_Authentication'=>date('Y-m-d H:i:s'),
            ]);
            return redirect()->route('ECommerce.index');
        }
        return redirect()->back()->with(['error' => 'email or Password Invalid']);
    }
}
