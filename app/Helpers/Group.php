<?php
namespace App\Helpers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Group {
    public static function group() {
        $group=user::find(Auth::id());
        return $group->user_groups;
    }
}