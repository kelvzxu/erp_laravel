<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;

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

Route::get('/', [BaseController::class, 'AuthorizesDatabase']);
    Route::group(['prefix'=>'web'],function(){
        Route::group(['prefix'=>'database'],function(){
            Route::get('/create', [BaseController::class, 'CreateDatabase'])->name('CreateDatabase');
        });
        Route::group(['prefix'=>'datasource'],function(){
            Route::get('/registration', [BaseController::class, 'DatasourceRegistration'])->name('RegisterDatasource');
            Route::post('/save', [BaseController::class, 'DatasourceSaved'])->name('SaveDatasource');
    });
});