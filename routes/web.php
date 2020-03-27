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
    Route::get('/partner', 'ResPartnersController@index')->name('partner');
    Route::get('/partner/new', 'ResPartnersController@create')->name('partner.new');
    Route::post('/partner/store','ResPartnersController@store')->name('partner.store');
    Route::get('/partner/show/{res_partner}','ResPartnersController@show')->name('partner.show');
    Route::post('/partner/update','ResPartnersController@update')->name('partner.update');
    Route::get('/partner/destroy/{res_partner}','ResPartnersController@destroy')->name('partner.destroy');
    
    // ==== Customer ====
    Route::get('/customer','ResCustomersController@index')->name('customer');
    Route::get('/customer/new','ResCustomersController@create')->name('customer.new');
    Route::post('/customer/store','ResCustomersController@store')->name('customer.store');
    Route::get('/customer/show/{res_customer}','ResCustomersController@show')->name('customer.show');
    Route::post('/customer/update','ResCustomersController@update')->name('customer.update');
    Route::get('/customer/destroy/{res_customer}','ResCustomersController@destroy')->name('customer.destroy');
    
    // ==== Invoices ====
    Route::get('/invoice','InvoicesController@index')->name('invoice');
    Route::get('/invoice/new','InvoicesController@create')->name('invoice.new');
    
    // ==== Employee ====
    Route::get('employee','HrEmployeesController@index')->name('employee');
    Route::get('employee/new','HrEmployeesController@create')->name('employee.new');

    // ==== HR Department ====
    Route::get('department','DepartmentController@index')->name('department');
    Route::get('department/create','DepartmentController@create')->name('department.create');
    Route::post('department/store', 'DepartmentController@store')->name('department.store');
    Route::get('department/edit/{id}','DepartmentController@edit')->name('department.edit');
    Route::post('department/update/{id}','DepartmentController@update')->name('department.update');
    Route::get('department/delete/{id}','DepartmentController@delete')->name('department.delete');


    // ==== Recruitment ====
    Route::get('recruitment','HrEmployeesController@index')->name('recruitment');

    // ==== Product =====
    Route::get('/product', 'ProductController@index')->name('product');
    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::post('/product/store', 'ProductController@store')->name('product.store');
    Route::get('/product/edit', 'ProductController@edit')->name('product.edit');
    Route::get('/product/edit{id}', 'ProductController@edit')->name('product.edit');
    Route::get('/product/destroy', 'ProductController@destroy')->name('product.destroy');
    Route::put('/product/update', 'ProductController@update')->name('product.update');

    // ==== Product Categories ==== 
    Route::get('/product-categories', 'CategoryController@index')->name('product-categories');
    Route::post('/product-categories/destroy', 'CategoryController@destroy')->name('product-categories.destroy');
    Route::post('/product-categories/store', 'CategoryController@store')->name('product-categories.store');
    Route::get('/product-categories/edit', 'CategoryController@edit')->name('product-categories.edit');
    Route::get('/product-categories/edit{id}', 'CategoryController@edit')->name('product-categories.edit');
    Route::put('/product-categories/update', 'CategoryController@update')->name('product-categories.update');

    // ==== Point Of Sale ====
    Route::get('/pos', 'OrderController@addOrder')->name('pos');
    Route::get('/pos/checkout', 'OrderController@checkout')->name('order.checkout');
    Route::post('/poscheckout', 'OrderController@storeOrder')->name('order.storeOrder');
});  
Auth::routes();


