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
    Route::get('ECommerce', 'ECommerceController@index')->name('ECommerce.index');  

    Route::get('/uom/{any}', function () {
        return view('inventory.uom.vue');
    })->where('any', '.*');

    Route::get('/inventory/product/{any}', function () {
        return view('inventory.product.vue');
    })->where('any', '.*');

    Route::get('/inventory/category/{any}', function () {
        return view('inventory.category.vue');
    })->where('any', '.*');

    Route::get('/inventory/warehouse/{any}', function () {
        return view('inventory.warehouse.vue');
    })->where('any', '.*');

    Route::get('/logistic/{any}', function () {
        return view('inventory.logistics.vue');
    })->where('any', '.*');

    Route::get('/sales/{any}', function () {
        return view('sales.vue');
    })->where('any', '.*');

    Route::get('/purchases/{any}', function () {
        return view('purchases.vue');
    })->where('any', '.*');

    Route::get('/contact/{any}',function(){
        return view('contact.partner.vue');
    })->where('any', '.*');
    
    Route::get('/hr/employee/{any}',function(){
        return view('hr.employee.vue');
    })->where('any', '.*');

    Route::get('/hr/contract/{any}',function(){
        return view('hr.contract.vue');
    })->where('any', '.*');

    Route::get('/hr/department/{any}',function(){
        return view('hr.department.vue');
    })->where('any', '.*');

    Route::get('/hr/job/{any}',function(){
        return view('hr.job.vue');
    })->where('any', '.*');

    Route::get('/setting/company/{any}',function(){
        return view('setting.company.vue');
    })->where('any', '.*');

    Route::get('/attendance/{any}',function(){
        return view('attendance.vue');
    })->where('any', '.*');

    Route::get('/language/{any}',function(){
        return view('setting.language.vue');
    })->where('any', '.*');

    Route::get('/config/web/{any}',function(){
        return view('setting.general.vue');
    })->where('any', '.*');

    // ==== Apps ====
    Route::get('Apps','AppsController@index')->name('Apps.index');
    Route::get('Apps/install/{id}','AppsController@install')->name('Apps.install');
    
    // ==== Attendance ====
    Route::post('/checkin{id}', 'HrAttendanceController@store')->name('checkin');
    Route::post('/checkout{id}', 'HrAttendanceController@update')->name('checkout');
    Route::get('/attendances', 'HrAttendanceController@index')->name('attendance');
    Route::get('/attendances/filter', 'HrAttendanceController@search')->name('attendance.filter');

    Route::post('chat', 'ChatController@store')->name('chat.store');
    Route::post('chat/join', 'ChatController@join')->name('chat.join');

    // ==== HR Department ====
    Route::get('department','HrDepartmentController@index')->name('department');
    Route::get('department/create','HrDepartmentController@create')->name('department.create');
    Route::post('department/store', 'HrDepartmentController@store')->name('department.store');
    Route::get('department/edit/{id}','HrDepartmentController@edit')->name('department.edit');
    Route::post('department/update/{id}','HrDepartmentController@update')->name('department.update');
    Route::get('department/delete/{id}','HrDepartmentController@destroy')->name('department.delete');
    
    // ==== Employee ====
    Route::get('employee','HrEmployeesController@index')->name('employee');
    Route::get('employee/create','HrEmployeesController@create')->name('employee.create');
    Route::post('employee/store','HrEmployeesController@store')->name('employee.store');
    Route::get('employee/edit/{hr_employee}','HrEmployeesController@edit')->name('employee.edit');
    Route::post('employee/update','HrEmployeesController@update')->name('employee.update');
    Route::get('employee/delete/{id}','HrEmployeesController@destroy')->name('employee.delete');
    Route::get('employee/filter','HrEmployeesController@search')->name('employee.filter');
   
    // ==== HR Department ====
    Route::get('jobs','HrJobsController@index')->name('jobs');
    Route::get('jobs/create','HrJobsController@create')->name('jobs.create');
    Route::post('jobs/store', 'HrJobsController@store')->name('jobs.store');
    Route::get('jobs/edit/{id}','HrJobsController@edit')->name('jobs.edit');
    Route::post('jobs/update/{id}','HrJobsController@update')->name('jobs.update');
    Route::get('jobs/delete/{id}','HrJobsController@destroy')->name('jobs.delete');
    
    // ==== Leave ====
    Route::get('leave','LeaveController@index')->name('leave');
    Route::post('leave/store','LeaveController@store')->name('leave.store');
    Route::post('leave/approve/{id}','LeaveController@approve')->name('leave.approve');
    Route::post('leave/paid/{id}','LeaveController@paid')->name('leave.paid');
    Route::get('leave/filter','LeaveController@search')->name('leave.filter');

    // ==== HR PaySlip ====
    Route::get('payslip','ManageSalaryController@index')->name('payslip');
    Route::get('payslip/payment/{id}','ManageSalaryController@payment')->name('payslip.payment');
    Route::get('payslip/filter','ManageSalaryController@search')->name('payslip.filter');
    Route::get('payslip/create','ManageSalaryController@create')->name('payslip.create');
    Route::post('payslip/store','ManageSalaryController@store')->name('payslip.store');
   
    // ==== Internal User ====
    Route::get('User/InternalUser','AccessRightsController@internalUser')->name('internaluser.index');
    Route::get('User/InternalUser/Detail/{id}','AccessRightsController@show')->name('internaluser.show');
    Route::post('User/update/{id}','AccessRightsController@update')->name('user_setting.update');
    
    // ==== Manage Companies ===== 
    Route::get('Companies', 'ResCompaniesController@index')->name('companies.index');
    Route::get('Companies/new', 'ResCompaniesController@create')->name('companies.create');
    Route::post('Companies/store', 'ResCompaniesController@store')->name('companies.store');
    Route::get('Companies/view/{id}', 'ResCompaniesController@show')->name('companies.show');
    Route::get('Companies/edit/{id}', 'ResCompaniesController@edit')->name('companies.edit');
    Route::post('Companies/update', 'ResCompaniesController@update')->name('companies.update');

    // ==== Portal User ====
    Route::get('User/Portal','AccessRightsController@portal')->name('portal.index');
    // ==== Recruitment ====
    Route::get('recruitment','HrRecruitmentController@index')->name('recruitment');

    // ==== Profile ====
    Route::get('profile','ProfileController@index')->name('profile');
    Route::post('profile.update','ProfileController@update')->name('profile.update');
    
    // ==== Point Of Sale ====
    Route::get('PointOfSale', 'OrderController@index')->name('pos');
    Route::post('PointOfSale/store', 'OrderController@store')->name('pos.store');
    Route::get('PointOfSale/Transaction', 'OrderController@create')->name('pos.create');
    Route::get('PointOfSale/Transaction/View/{id}', 'OrderController@view')->name('pos.view');
    Route::get('PointOfSale/Search', 'OrderController@search')->name('pos.filter');
    Route::get('/checkout', 'OrderController@checkout')->name('order.checkout');
    Route::post('/checkout', 'OrderController@storeOrder')->name('order.storeOrder');

    // ==== Sales ====
    Route::group(['namespace' => '\App\Addons\Sales\Controllers'], function()
    {
        Route::get('Sales/Report', 'SalesOrdersController@report')->name('sales_orders.report');
        Route::get('Sales/print/{id}', 'SalesOrdersController@print')->name('sales_orders.print_pdf');
        Route::get('Sales/Report/print', 'SalesOrdersController@print_report')->name('sales_orders.print');
    });

    // ==== Purchase ====
    Route::group(['namespace' => '\App\Addons\Purchase\Controllers'], function()
    {
        Route::get('purchases', 'PurchasesOrdersController@index')->name('purchase_orders');
        Route::get('purchases/create', 'PurchasesOrdersController@create')->name('purchase_orders.create');
        Route::post('purchases', 'PurchasesOrdersController@store')->name('purchase_orders.store');
        Route::get('purchases/show/{id}', 'PurchasesOrdersController@show')->name('purchase_orders.show');
        Route::get('purchases/edit/{id}', 'PurchasesOrdersController@edit')->name('purchase_orders.edit');
        Route::get('purchases/confirm/{id}', 'PurchasesOrdersController@confirm')->name('purchase_orders.confirm');
        Route::put('purchases/update/{id}', 'PurchasesOrdersController@update')->name('purchase_orders.update');
        Route::get('purchases/Report', 'PurchasesOrdersController@report')->name('purchase_orders.report');
        Route::get('purchases/print/{id}', 'PurchasesOrdersController@print')->name('purchase_orders.print_pdf');
        Route::get('purchases/Report/Print', 'PurchasesOrdersController@print_report')->name('purchase_orders.print');
    });

    // ==== Inventory ==== 
    Route::group(['namespace' => '\App\Addons\Inventory\Controllers'], function()
    {
        // ==== Product Category ====
        Route::get('product-categories', 'CategoryController@index')->name('product-categories');
        Route::post('product-categories/destroy', 'CategoryController@destroy')->name('product-categories.destroy');
        Route::post('product-categories/store', 'CategoryController@store')->name('product-categories.store');
        Route::get('product-categories/edit', 'CategoryController@edit')->name('product-categories.edit');
        Route::get('product-categories/edit{id}', 'CategoryController@edit')->name('product-categories.edit');
        Route::put('product-categories/update', 'CategoryController@update')->name('product-categories.update');

        // ==== Product ====
        Route::get('product', 'ProductController@index')->name('product');
        Route::get('product/create', 'ProductController@create')->name('product.create');
        Route::post('product/store', 'ProductController@store')->name('product.store');
        Route::get('product/edit', 'ProductController@edit')->name('product.edit');
        Route::get('product/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::get('product/filter', 'ProductController@search')->name('product.filter');
        Route::get('product/destroy{id}', 'ProductController@destroy')->name('product.destroy');
        Route::put('product/update', 'ProductController@update')->name('product.update');
        Route::get('product/Report/productlist', 'ProductController@product_report')->name('report.productlist');
        Route::get('product/Report/Stock', 'ProductController@stock_report')->name('report.productstock');

        // ==== Delivery ====
        Route::get('Delivere', 'DelivereProductController@index')->name('Delivere.index');
        Route::get('Delivere/store/{id}', 'DelivereProductController@store')->name('Delivere.store');
        Route::get('Delivere/show/{id}', 'DelivereProductController@show')->name('Delivere.show');
        Route::get('Delivere/validate/{id}', 'DelivereProductController@validation')->name('Delivere.validate');
        Route::get('Delivere/return/{id}', 'DelivereProductController@return')->name('Delivere.return');
    
        // ==== inventory report ====
        Route::get('Inventory/report/valuation','InventoryReportController@valuation')->name('inventory.valuation');
        Route::get('Inventory/report/Move','InventoryReportController@move')->name('inventory.move');
        Route::get('Inventory/report/valuation/Print','InventoryReportController@print_valuation')->name('inventory.print_valuation');
        Route::get('Inventory/report/Move/Print','InventoryReportController@print_move')->name('inventory.print_move');

         // ==== Receive ====
        Route::get('receive', 'ReceiveProductController@index')->name('receipt.index');
        Route::get('receive/store/{id}', 'ReceiveProductController@store')->name('receipt.store');
        Route::get('receive/show/{id}', 'ReceiveProductController@show')->name('receipt.show');
        Route::get('receive/validate/{id}', 'ReceiveProductController@validation')->name('receipt.validate');
        Route::get('receive/return/{id}', 'ReceiveProductController@return')->name('receipt.return');

    });

    // ==== Invoicing ====
    Route::group(['namespace' => '\App\Addons\Invoicing\Controllers'], function()
    {
        // ==== Invoices ====
        Route::get('invoices', 'InvoiceController@index')->name('invoices');
        Route::get('invoices/create', 'InvoiceController@create')->name('invoices.create');
        Route::get('invoices/create/{id}', 'InvoiceController@wizard_create')->name('invoices.wizard_create');
        Route::post('invoices', 'InvoiceController@store')->name('invoices.store');
        Route::get('invoices/show/{id}', 'InvoiceController@show')->name('invoices.show');
        Route::get('invoices/edit/{id}', 'InvoiceController@edit')->name('invoices.edit');
        Route::put('invoices/update/{id}', 'InvoiceController@update')->name('invoices.update');
        Route::get('invoices/destroy', 'InvoiceController@destroy')->name('invoices.destroy');
        Route::get('invoices/filter', 'InvoiceController@search')->name('invoices.filter');
        Route::get('invoices/print{id}', 'InvoiceController@print_pdf')->name('invoices.print');
        Route::get('invoices/approved/{id}', 'InvoiceController@approved')->name('invoices.approved');
        Route::get('Reports/invoices', 'InvoiceController@report')->name('invoices.report');
        Route::get('Reports/invoices/print', 'InvoiceController@print_report')->name('invoices_report.print');

        // ==== Bills ====
        Route::get('VendorBills', 'BillsController@index')->name('purchases');
        Route::get('VendorBills/create', 'BillsController@create')->name('purchases.create');
        Route::get('VendorBills/create/{id}', 'BillsController@wizard_create')->name('purchases.wizard_create');
        Route::post('VendorBills', 'BillsController@store')->name('purchases.store');
        Route::get('VendorBills/show/{id}', 'BillsController@show')->name('purchases.show');
        Route::get('VendorBills/edit/{id}', 'BillsController@edit')->name('purchases.edit');
        Route::put('VendorBills/update/{id}', 'BillsController@update')->name('purchases.update');
        Route::get('VendorBills/destroy', 'BillsController@destroy')->name('purchases.destroy');
        Route::get('VendorBills/filter', 'BillsController@search')->name('purchases.filter');
        Route::get('VendorBills/approved/{id}', 'BillsController@approved')->name('purchases.approved');
        Route::get('VendorBills/print/{id}', 'BillsController@print_pdf')->name('purchases.print');
        Route::get('Reports/VendorBills', 'BillsController@report')->name('purchases.report');
        Route::get('Reports/VendorBills/print', 'BillsController@report_print')->name('purchases_report.print');
    
        // ==== Customer Payment ====
        Route::get('CustomerDebt','CustomerDeptController@index')->name('CustomerDebt');
        Route::get('CustomerDebt/show/{id}','CustomerDeptController@show')->name('CustomerDebt.show');
        Route::get('CustomerDebt/edit/{id}','CustomerDeptController@edit')->name('CustomerDebt.edit');
        Route::post('CustomerDebt/update','CustomerDeptController@update')->name('CustomerDebt.update');
        Route::get('CustomerDebt/report','CustomerDeptController@report')->name('CustomerDebt.report');
        Route::get('CustomerDebt/report/print','CustomerDeptController@report_print')->name('CustomerDebt_report.print');

        // ==== PartnerCredit=
        Route::get('PartnerDebt','PartnerCreditController@index')->name('PartnerDebt');
        Route::get('PartnerDebt/show/{id}','PartnerCreditController@show')->name('PartnerDebt.show');
        Route::get('PartnerDebt/edit/{id}','PartnerCreditController@edit')->name('PartnerDebt.edit');
        Route::post('PartnerDebt/update','PartnerCreditController@update')->name('PartnerDebt.update');
        
        // ==== Payable Account ====
        Route::get('PayableAccount','PayableController@index')->name('PayableAccount.index');
        Route::get('PayableAccount/print','PayableController@print')->name('PayableAccount.Print');

        // ==== Receivable Account ====
        Route::get('ReceivableAccount','ReceivableAccountController@index')->name('ReceivableAccount.index');
        Route::get('ReceivableAccount/print','ReceivableAccountController@print')->name('ReceivableAccount.Print');

        // ==== Retur Invoice ====
        Route::get('Report/Return/SalesOrder','ReturnInvoiceController@index')->name('return-invoice.index');
        Route::post('Return/SalesOrder/', 'ReturnInvoiceController@store')->name('return-invoice.store');
        Route::get('Report/Return/SalesOrder/{id}','ReturnInvoiceController@view')->name('return-invoice.view');
        Route::get('Report/Return/SalesOrder/Edit/{id}','ReturnInvoiceController@edit')->name('return-invoice.edit');
        Route::post('Return/SalesOrder/update', 'ReturnInvoiceController@update')->name('return-invoice.update');

        // ==== Retur Purchase ====
        Route::get('Report/Return/Purchase/','ReturnPurchaseController@index')->name('return-po.index');
        Route::post('Return/Purchase/', 'ReturnPurchaseController@store')->name('return-po.store');
        Route::get('Report/Return/Purchase/{id}','ReturnPurchaseController@view')->name('return-po.view');
        Route::get('Report/Return/Purchase/Edit/{id}','ReturnPurchaseController@edit')->name('return-po.edit');
        Route::post('Return/Purchase/Update', 'ReturnPurchaseController@update')->name('return-po.update');

    });

    // ==== Accounting ====
    Route::group(['namespace' => '\App\Addons\Accounting\Controllers'] , function() 
    {
        // ==== Account Account ====
        Route::get('Account','AccountAccountController@index')->name('account.index');
        Route::get('Account/create','AccountAccountController@create')->name('account.create');
        Route::post('Account/store','AccountAccountController@store')->name('account.store');
        Route::get('Account/edit/{id}','AccountAccountController@edit')->name('account.edit');
        Route::put('Account/update','AccountAccountController@update')->name('account.update');
        Route::get('Account/destroy/{id}','AccountAccountController@destroy')->name('account.destroy');
        Route::get('Account/filter','AccountAccountController@search')->name('account.filter');

        // ==== Account Journal ====
        Route::get('Account/Journal','AccountJournalController@index')->name('journal.index');
        Route::get('Account/Journal/create','AccountJournalController@create')->name('journal.create');
        Route::post('Account/Journal/store','AccountJournalController@store')->name('journal.store');
        Route::get('Account/Journal/edit/{id}','AccountJournalController@edit')->name('journal.edit');
        Route::put('Account/Journal/update/{id}','AccountJournalController@update')->name('journal.update');
        Route::get('Account/Journal/destroy/{id}','AccountJournalController@destroy')->name('journal.destroy');
        Route::get('Account/Journal/filter','AccountJournalController@search')->name('journal.filter');
        
        // ==== Account Move ====
        Route::get('AccountMove','AccountMovesController@index')->name('accountmove.index');
        Route::get('AccountMove/invoice/{id}','AccountMovesController@invoice')->name('accountmove.invoice');
        Route::get('AccountMove/purchase/{id}','AccountMovesController@purchase')->name('accountmove.purchase');
        Route::get('AccountMove/payment/{id}','AccountMovesController@payment')->name('accountmove.payment');

        // ==== Accounting Report ====
        Route::get('Accounting/Report/General_Ledger','AccountReportController@generalledger')->name('accounting.general_ledger');
        Route::get('Accounting/Report/Partner_Ledger','AccountReportController@partnerledger')->name('accounting.partner_ledger');
        Route::get('Accounting/Report/General_Ledger/Print','AccountReportController@print_gl')->name('accounting.general_ledger_print');
        Route::get('Accounting/Report/Partner_Ledger/Print/{type}','AccountReportController@print_pl')->name('accounting.partner_ledger_print');
    
        // ==== Paymeny Invoice ====
        Route::get('Payments/Invoices', 'AccountPaymentsController@index')->name('payment_invoices.index');
        Route::get('Payments/Invoices/Register', 'AccountPaymentsController@create')->name('payment_invoices.create');
        Route::get('Payments/Invoices/Reconcile/{id}', 'PaymentMatchingController@invoice')->name('reconcile.invoice');
        Route::post('Payments/Invoices/Reconcile/store', 'PaymentMatchingController@invoice_store')->name('reconcile.invoice_store');
        
        // ==== Paymeny Bills ====
        Route::get('Payments/Bills', 'AccountPaymentsController@vendor_index')->name('payment_bills.index');
        Route::get('Payments/Bills/Register', 'AccountPaymentsController@vendor_create')->name('payment_bills.create');
        Route::get('Payments/Bill/Reconcile/{id}', 'PaymentMatchingController@bill')->name('reconcile.bill');
        Route::post('Payments/Bill/Reconcile/store', 'PaymentMatchingController@bill_store')->name('reconcile.bill_store');

        // save &Update Payments ==== 
        Route::post('Payments/store', 'AccountPaymentsController@store')->name('payment.store');
        Route::post('Payments/update', 'AccountPaymentsController@update')->name('payment.update');
        Route::get('Payments/View/{id}', 'AccountPaymentsController@view')->name('payment.view');
        Route::get('Payments/edit/{id}', 'AccountPaymentsController@edit')->name('payment.edit');
        Route::get('Payments/Confirm/{id}', 'AccountPaymentsController@posted')->name('payment.posted');

    });

});  
Auth::routes(['verify' => true]);



