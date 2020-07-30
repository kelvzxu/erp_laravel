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
Route::get('state','ResCountryStatesController@index');
Route::get('state/search','ResCountryStatesController@search');
Route::get('currency','ResCurrencyController@index');
Route::get('industry','ResPartnerIndustryController@index');
Route::get('lang','ResLangController@index');
Route::get('tz','ResTimeZoneController@index');

Route::get('/product/{id}', 'OrderController@getProduct');
Route::post('/cart', 'OrderController@addToCart');
Route::get('/cart', 'OrderController@getCart');
Route::delete('/cart/{id}', 'OrderController@removeCart');
Route::post('/product/search', 'ProductController@searchapi');
Route::post('/employee/search', 'HrEmployeesController@searchapi');
Route::get('/attendance', 'HrAttendanceController@checkatd');
Route::post('/atd-count', 'HrAttendanceController@getcount');
Route::post('/leave', 'ManageSalaryController@getcount');

// ==== Inventory ==== 
Route::group(['namespace' => '\App\Addons\Inventory\Controllers'], function()
{
    Route::get('Products','ProductController@Products');
    Route::get('Products/sale','ProductController@ProductSale');
    Route::get('getProduct','ProductController@getProduct');
    Route::get('getProduct/id','ProductController@getProductById');
});

Route::get('/chart', 'HomeController@getChart');

// ==== Sales ====
Route::group(['namespace' => '\App\Addons\Sales\Controllers'], function()
{
    Route::get('/sale/list', 'SalesOrdersController@fetchSalesOrder');
});
// ==== Contact ====
Route::group(['namespace' => '\App\Addons\Contact\Controllers'], function()
{
    Route::post('/customer/search', 'ResCustomersController@searchapi');
    Route::post('/partner/search', 'ResPartnersController@searchapi');
});

// get Access Rights
Route::get('/user/Access/{id}','UserController@getAccessRight');
Route::get('/user/Group/{id}','UserController@getGroup');
