<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenyandangController;
use App\Http\Controllers\PersebaranController;
use App\Http\Controllers\RelawanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'login_index'])->name('login.index');
    Route::post('/login/authenticate', [AuthController::class, 'login_authenticate'])->name('login.authenticate');
    Route::get('/register', [AuthController::class, 'register_index'])->name('register.index');
    Route::post('/register/submit', [AuthController::class, 'register_submit'])->name('register.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
});

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::prefix('master')->name('master.')->middleware([])->group(function () {
        Route::resource('/relawan', RelawanController::class)->names('relawan');
        Route::resource('/penyandang', PenyandangController::class)->names('penyandang');
    });
    Route::resource('/persebaran', PersebaranController::class)->names('persebaran');
    Route::resource('/bantuan', BantuanController::class)->names('bantuan');
});
