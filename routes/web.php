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
    Route::get('/partner/filter', 'ResPartnersController@search')->name('partner.filter');

    // ==== Customer ====
    Route::get('/customer','ResCustomersController@index')->name('customer');
    Route::get('/customer/new','ResCustomersController@create')->name('customer.new');
    Route::post('/customer/store','ResCustomersController@store')->name('customer.store');
    Route::get('/customer/show/{res_customer}','ResCustomersController@show')->name('customer.show');
    Route::post('/customer/update','ResCustomersController@update')->name('customer.update');
    Route::get('/customer/destroy/{res_customer}','ResCustomersController@destroy')->name('customer.destroy');
    Route::get('/customer/filter','ResCustomersController@search')->name('customer.filter');

    // ==== Customer ====
    Route::get('/CustomerDebt','CustomerDeptController@index')->name('CustomerDebt');
    Route::get('/CustomerDebt/show/{id}','CustomerDeptController@show')->name('CustomerDebt.show');
    Route::get('/CustomerDebt/edit/{id}','CustomerDeptController@edit')->name('CustomerDebt.edit');
    Route::post('/CustomerDebt/update','CustomerDeptController@update')->name('CustomerDebt.update');

    // ==== PartnerCredit=
    Route::get('/PartnerDebt','PartnerCreditController@index')->name('PartnerDebt');
    Route::get('/PartnerDebt/show/{id}','PartnerCreditController@show')->name('PartnerDebt.show');
    Route::get('/PartnerDebt/edit/{id}','PartnerCreditController@edit')->name('PartnerDebt.edit');
    Route::post('/PartnerDebt/update','PartnerCreditController@update')->name('PartnerDebt.update');

    // ==== Invoices ====
    Route::get('/invoices', 'InvoiceController@index')->name('invoices');
    Route::get('/invoices/create', 'InvoiceController@create')->name('invoices.create');
    Route::post('/invoices', 'InvoiceController@store')->name('invoices.store');
    Route::get('/invoices/show{id}', 'InvoiceController@show')->name('invoices.show');
    Route::get('/invoices/edit{id}', 'InvoiceController@edit')->name('invoices.edit');
    Route::put('/invoices/update/{id}', 'InvoiceController@update')->name('invoices.update');
    Route::get('/invoices/destroy', 'InvoiceController@destroy')->name('invoices.destroy');
    Route::get('/invoices/filter', 'InvoiceController@search')->name('invoices.filter');

    // ==== purchases ====
    Route::get('/purchases', 'PurchaseController@index')->name('purchases');
    Route::get('/purchases/create', 'PurchaseController@create')->name('purchases.create');
    Route::post('/purchases', 'PurchaseController@store')->name('purchases.store');
    Route::get('/purchases/show{id}', 'PurchaseController@show')->name('purchases.show');
    Route::get('/purchases/edit{id}', 'PurchaseController@edit')->name('purchases.edit');
    Route::put('/purchases/update/{id}', 'PurchaseController@update')->name('purchases.update');
    Route::get('/purchases/destroy', 'PurchaseController@destroy')->name('purchases.destroy');
    Route::get('/purchases/filter', 'PurchaseController@search')->name('purchases.filter');
    
    // ==== Employee ====
    Route::get('employee','HrEmployeesController@index')->name('employee');
    Route::get('employee/new','HrEmployeesController@create')->name('employee.new');
    Route::post('employee/store','HrEmployeesController@store')->name('employee.store');
    Route::get('employee/edit/{hr_employee}','HrEmployeesController@edit')->name('employee.edit');
    Route::post('employee/update','HrEmployeesController@update')->name('employee.update');
    Route::get('employee/delete/{id}','HrEmployeesController@destroy')->name('employee.delete');
    Route::get('employee/filter','HrEmployeesController@search')->name('employee.filter');

    // ==== HR Department ====
    Route::get('department','HrDepartmentController@index')->name('department');
    Route::get('department/create','HrDepartmentController@create')->name('department.create');
    Route::post('department/store', 'HrDepartmentController@store')->name('department.store');
    Route::get('department/edit/{id}','HrDepartmentController@edit')->name('department.edit');
    Route::post('department/update/{id}','HrDepartmentController@update')->name('department.update');
    Route::get('department/delete/{id}','HrDepartmentController@destroy')->name('department.delete');

    // ==== HR Department ====
    Route::get('jobs','HrJobsController@index')->name('jobs');
    Route::get('jobs/create','HrJobsController@create')->name('jobs.create');
    Route::post('jobs/store', 'HrJobsController@store')->name('jobs.store');
    Route::get('jobs/edit/{id}','HrJobsController@edit')->name('jobs.edit');
    Route::post('jobs/update/{id}','HrJobsController@update')->name('jobs.update');
    Route::get('jobs/delete/{id}','HrJobsController@destroy')->name('jobs.delete');

    // ==== HR PaySlip ====
    Route::get('payslip','ManageSalaryController@index')->name('payslip');
    Route::get('payslip/payment/{id}','ManageSalaryController@payment')->name('payslip.payment');
    Route::get('payslip/filter','ManageSalaryController@search')->name('payslip.filter');
    Route::get('payslip/create','ManageSalaryController@create')->name('payslip.create');
    Route::post('payslip/store','ManageSalaryController@store')->name('payslip.store');

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

    // ==== Attendance ====
    Route::post('/checkin{id}', 'HrAttendanceController@store')->name('checkin');
    Route::post('/checkout{id}', 'HrAttendanceController@update')->name('checkout');
    Route::get('/attendance', 'HrAttendanceController@index')->name('attendance');
    Route::get('/attendance/filter', 'HrAttendanceController@search')->name('attendance.filter');

    // ==== Leave ====
    Route::get('leave','LeaveController@index')->name('leave');
    Route::post('leave/store','LeaveController@store')->name('leave.store');
    Route::post('leave/approve/{id}','LeaveController@approve')->name('leave.approve');
    Route::post('leave/paid/{id}','LeaveController@paid')->name('leave.paid');
    Route::get('leave/filter','LeaveController@search')->name('leave.filter');
    
    // ==== Point Of Sale ====
    Route::get('/pos', 'OrderController@addOrder')->name('pos');
    Route::get('/pos/checkout', 'OrderController@checkout')->name('order.checkout');
    Route::post('/poscheckout', 'OrderController@storeOrder')->name('order.storeOrder');
    Route::get('/transaksi', 'OrderController@addOrder')->name('order.transaksi');
    Route::get('/checkout', 'OrderController@checkout')->name('order.checkout');
    Route::post('/checkout', 'OrderController@storeOrder')->name('order.storeOrder');
});  
Auth::routes();


