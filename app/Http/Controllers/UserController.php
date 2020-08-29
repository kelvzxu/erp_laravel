<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\access_right;
use App\User;

class UserController extends Controller
{
    public function GetAccessRight($id){
        $user = User::where('email',$id)->first();
        $access=access_right::where('user_id',$user->id)->first();
        if($user->id !=""){
            return response()->json([
                'status' => 'success',
                'data' => $access
            ], 200);
        } else{
            return response()->json([
                'status' => 'Error',
                'data' => 'User not found'
            ], 200);
        }
            
    }

    public function getUser($id){
        $response = User::where('email',$id)->first();
        if ($response) {
            return response()->json([
                'status' => 'success',
                'result' => $response
            ], 200);
        }
        return response()->json([
            'status' => 'failed',
            'result' => []
        ]);
    }

    public function CountInternalUser()
    {
        try {
            $response = User::with('type')->where('user_type',1)->count();
            return response()->json([
                'status' => 'success',
                'result' => $response
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'result' => []
            ]);
        }
    }
    public function CountPortalUser()
    {
        try {
            $response = User::with('type')->where('user_type',2)->count();
            return response()->json([
                'status' => 'success',
                'result' => $response
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'failed',
                'result' => []
            ]);
        }
    }
}
