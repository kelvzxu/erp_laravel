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
Route::group(['middleware' => 'auth'], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    
    // ==== Purchase =====
    Route::get('/partner', 'ResPartnersController@index');
    Route::get('/partner/new', 'ResPartnersController@create');
    
    // ==== Customer ====
    Route::get('/customer','ResCustomersController@index')->name('customer');
    Route::get('/customer/new','ResCustomersController@create')->name('customer.new');
    
    // ==== Invoices ====
    Route::get('/invoice','InvoicesController@index');
    Route::get('/invoice/new','InvoicesController@create');
    
    // ==== Employee ====
    Route::get('employee','HrEmployeesController@index')->name('employee');
    Route::get('employee/new','HrEmployeesController@create')->name('employee.new');
});  
Auth::routes();


