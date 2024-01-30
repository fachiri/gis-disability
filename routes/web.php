<?php

use App\Http\Controllers\BantuanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenyandangController;
use App\Http\Controllers\PersebaranController;
use App\Http\Controllers\RelawanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::prefix('dashboard')->middleware([])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::prefix('master')->name('master.')->middleware([])->group(function () {
        Route::resource('/relawan', RelawanController::class)->names('relawan');
        Route::resource('/penyandang', PenyandangController::class)->names('penyandang');
    });
    Route::resource('/persebaran', PersebaranController::class)->names('persebaran');
    Route::resource('/bantuan', BantuanController::class)->names('bantuan');
});
