<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RelawanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::prefix('dashboard')->middleware([])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::prefix('master')->name('master.')->middleware([])->group(function () {
        Route::resource('/relawan', RelawanController::class)->names('relawan');
    });
});
