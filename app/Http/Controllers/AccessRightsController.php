<?php

namespace App\Http\Controllers;

use App\User;
use App\user_type;
use App\user_group;
use App\access_right;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class AccessRightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function InternalUser()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $user = User::with('type')->where('user_type',1)->orderBy('name')->paginate(25);
        return view ('manage_users.internal_user',compact('user','access','group'));
    }
    public function portal()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $user = User::with('type')->where('user_type',2)->orderBy('name')->paginate(25);
        return view ('manage_users.portal',compact('user','access','group'));
    }

    public function show($id)
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $type=user_type::orderBy('id','asc')->get();
        $groups=user_group::orderBy('id','asc')->get();
        $user_access = access_right::with('user','employee')->where('user_id',$id)->first();
        return view ('manage_users.edit',compact('user_access','type','access','groups','group'));
    }

    public function update(Request $request, $id)
    {
        // try{

            user::find($id)->update([
                'name' =>$request->name,
                'email' =>$request->email,
                'user_type' =>$request->user_type,
                'user_groups' =>$request->user_groups,
            ]);
            access_right::where('user_id',$id)->update([
                'sales' =>$request->sales,
                'purchase' =>$request->purchase,
                'inventory' =>$request->inventory,
                'accounting' =>$request->accounting,
                'point_of_sale' =>$request->point_of_sale,
                'human_resources' =>$request->human_resources,
                'administration' =>$request->administration,
            ]);
            Toastr::success('user access with the name '.$request->name.' has been successfully updated','Success');
                return redirect(route('home'));
        // } catch (\Exception $e) {
        //     // Toastr::error($e->getMessage(),'Something Wrong');
        //     Toastr::error('Check In Error!','Something Wrong');
        //     return redirect()->back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\access_right  $access_right
     * @return \Illuminate\Http\Response
     */
    public function destroy(access_right $access_right)
    {
        //
    }
}
