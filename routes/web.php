<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->Middleware('verified');

// ==== Purchase =====
Route::get('/partner', 'ResPartnersController@index')->Middleware('verified');
Route::get('/partner/new', 'ResPartnersController@create')->Middleware('verified');

// ==== Customer ====
Route::get('/customer','ResCustomersController@index')->Middleware('verified');
Route::get('/customer/new', 'ResCustomersController@create')->Middleware('verified');
