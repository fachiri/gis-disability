<?php

use App\Constants\UserRole;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenyandangController;
use App\Http\Controllers\PersebaranController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\SecurityController;
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
    Route::prefix('master')->name('master.')->middleware(['roles:' . UserRole::ADMIN])->group(function () {
        Route::resource('/relawan', RelawanController::class)->names('relawan');
        Route::resource('/penyandang', PenyandangController::class)->names('penyandang');
    });
    Route::get('/penyandang', [PenyandangController::class, 'index'])->name('penyandang.index');
    Route::get('/penyandang/{penyandang}', [PenyandangController::class, 'show'])->name('penyandang.show');
    Route::resource('/persebaran', PersebaranController::class)->names('persebaran');
    Route::resource('/bantuan', BantuanController::class)->names('bantuan');
    Route::resource('/activity', ActivityController::class)->names('activity');
    Route::patch('/bantuan/{bantuan}/received', [BantuanController::class, 'received'])->name('bantuan.received');
    Route::prefix('security')->name('security.')->middleware([])->group(function () {
        Route::get('/', [SecurityController::class, 'index'])->name('index');
        Route::put('/update/password', [SecurityController::class, 'update_password'])->name('update.password');
    });
});
