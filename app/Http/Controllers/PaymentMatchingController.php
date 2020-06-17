<?php

namespace App\Http\Controllers;

use App\access_right;
use App\User;
use App\Models\Accounting\account_payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMatchingController extends Controller
{
    public function invoice()
    {
        $access=access_right::where('user_id',Auth::id())->first();
        $group=user::find(Auth::id());
        $data= account_payment::with('company','partner','journal')->where('partner_type','customer')->orderBy('name', 'DESC')->first();
        return view ('accounting.payment_matching.invoice.create',compact('data','access','group'));
    }
}
