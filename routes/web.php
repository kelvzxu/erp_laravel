<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BaseController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\DatabaseController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::prefix('/web')->group(function () {
    Route::prefix('/database')->group(function () {
        Route::prefix('/provider')->group(function () {
            Route::get('/', [DatabaseController::class, 'provider'])->name('database.provider');
            Route::post('/register', [DatabaseController::class, 'register'])->name('database.register');
        });

        Route::get('/manager', function () {
            return view('database.database');
        })->name('database.create');

        Route::get('/selector', [DatabaseController::class, 'DatabaseSelector'])->name('database.selector');

    });
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
