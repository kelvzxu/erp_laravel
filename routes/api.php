<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('country','ResCountryController@index');
Route::get('country','ResCountryController@index');
Route::get('state','ResCountryStatesController@index');
Route::get('state/search','ResCountryStatesController@search');
Route::get('currency','ResCurrencyController@index');
Route::get('industry','ResPartnerIndustryController@index');
Route::get('lang','ResLangController@index');
Route::get('lang/count','ResLangController@CountActiveLang');
Route::get('lang/fetch','ResLangController@FetchLang');
Route::post('lang/search/{id}', 'ResLangController@GetLang');
Route::post('lang/activate','ResLangController@activate');
Route::get('tz','ResTimeZoneController@index');
Route::post('/leave', 'ManageSalaryController@getcount');
Route::post('employee/search', 'HrEmployeesController@searchapi');
Route::get('employee/list', 'HrEmployeesController@fetchEmployees');
Route::get('/attendance', 'HrAttendanceController@checkatd');
Route::post('/atd-count', 'HrAttendanceController@getcount');

// company
Route::get('company','ResCompaniesController@companies');
Route::post('company/store','ResCompaniesController@store');
Route::get('company/count','ResCompaniesController@CountCompanies');

// ==== Inventory ==== 
Route::group(['namespace' => '\App\Addons\Inventory\Controllers'], function()
{
    Route::get('Products','ProductController@Products');
    Route::post('Product/store','ProductController@store');
    Route::post('Product/update','ProductController@update');
    Route::get('Products/sale','ProductController@ProductSale');
    Route::get('Products/Buy','ProductController@ProductBuy');
    Route::get('getProduct','ProductController@getProduct');
    Route::get('getProduct/id','ProductController@getProductById');

    Route::post('Products/quant/store','ProductQuantController@store');
    Route::post('Products/warehouse/quant/store','ProductQuantController@store_product');
    Route::post('Products/quant/update','ProductQuantController@UpdateQuant');

    Route::get('Products/category','CategoryController@fetchCategory');
    Route::post('Product/category/store','CategoryController@store');
    Route::post('Product/category/update','CategoryController@update');
    Route::get('Product/Category/{id}','CategoryController@getCategory');

    Route::get('warehouse','ProductWarehouseController@FetchWarehouse');
    Route::get('warehouse/{id}','ProductWarehouseController@getWarehouse');
    Route::post('warehouse/store','ProductWarehouseController@store');
    Route::post('warehouse/update','ProductWarehouseController@update');

    Route::post('stock_pickings/store','StockPickingsController@store');
    Route::post('stock_pickings/todo','StockPickingsController@todo');
    Route::post('stock_pickings/validate','StockPickingsController@validate_picking');
    Route::get('stock_pickings/search/{id}', 'StockPickingsController@getStockPicking');
    Route::get('stock_pickings/receipts/{id}','StockPickingsController@fetchReceiptPicking');
    Route::get('stock_pickings/delivere','StockPickingsController@fetchDeliverePicking');

    Route::get('Removal/Strategy','ProductRemovalController@fetchRemovalStrategy');
    
});

Route::get('/chart', 'HomeController@getChart');

// ==== Sales ====
Route::group(['namespace' => '\App\Addons\Accounting\Controllers'], function()
{
    Route::get('/fetchaccount/accounts', 'AccountAccountController@fetchAccountAccounts');
    Route::get('/fetchaccount/journal', 'AccountJournalController@fetchAccountJournals');
});
// ==== Sales ====
Route::group(['namespace' => '\App\Addons\Sales\Controllers'], function()
{
    Route::get('sale/list', 'SalesOrdersController@fetchSalesOrder');
    Route::post('sale/store', 'SalesOrdersController@store');
    Route::post('sale/update', 'SalesOrdersController@update');
    Route::post('sale/update/delivery', 'SalesOrdersController@updateDelivery');
    Route::post('sale/confirm', 'SalesOrdersController@confirm');
    Route::post('sale/delivere', 'SalesOrdersController@delivere');
    Route::get('sale/analysis', 'SalesOrdersController@sales_analysis');
    Route::get('sale/search/{id}', 'SalesOrdersController@getSalesOrder');
});

// ==== Purchases ====
Route::group(['namespace' => '\App\Addons\Purchase\Controllers'], function()
{
    Route::get('/purchase/list', 'PurchasesOrdersController@fetchPurchasesOrder');
    Route::post('/purchase/store', 'PurchasesOrdersController@store');
    Route::post('/purchase/update', 'PurchasesOrdersController@update');
    Route::post('/purchase/confirm', 'PurchasesOrdersController@confirm');
    Route::post('/purchase/receipts', 'PurchasesOrdersController@receipts');
    Route::get('/purchase/analysis', 'PurchasesOrdersController@purchases_analysis');
    Route::get('/purchase/search/{id}', 'PurchasesOrdersController@getPurchasesOrder');
});
// ==== Contact ====
Route::group(['namespace' => '\App\Addons\Contact\Controllers'], function()
{
    Route::post('customer/list', 'ResCustomersController@fetchCustomer');
    Route::post('customer/company/list', 'ResCustomersController@fetchCompany');
    Route::post('customer/search/{id}', 'ResCustomersController@searchapi');
    Route::post('customer/store', 'ResCustomersController@store');
    Route::post('customer/update', 'ResCustomersController@update');

    Route::post('vendor/list', 'ResPartnersController@fetchVendor');
    Route::post('vendor/company/list', 'ResPartnersController@fetchCompany');
    Route::post('vendor/search/{id}', 'ResPartnersController@searchapi');
    Route::post('vendor/store', 'ResPartnersController@store');
    Route::post('vendor/update', 'ResPartnersController@update');
});

// ==== UOM ====
Route::group(['namespace' => '\App\Addons\Uom\Controllers'], function()
{
    Route::get('/uom/list', 'UomController@fetchUom');
    Route::get('/uom/category/list','UomController@fetchUomCategory');
    Route::get('/uom/type/list','UomController@fetchUomType');
    Route::get('/uom/get_uom/{id}','UomController@getUom');
    Route::get('/uom/get_uom/category/{id}','UomController@fetchUomByCategory');
    Route::Post('/uom/store','UomController@store');
    Route::Post('/uom/update','UomController@update');
});

// get Access Rights
Route::get('/user/Access/{id}','UserController@getAccessRight');
Route::get('/user/{id}','UserController@getUser');
Route::get('/user/internal/count','UserController@CountInternalUser');
Route::get('/user/portal/count','UserController@CountportalUser');

// Addons
Route::get('/Addons/Check/{id}','AppsController@check_installed');

