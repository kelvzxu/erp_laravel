<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ECommerceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        return view('ecommerce.index');
    }
}
