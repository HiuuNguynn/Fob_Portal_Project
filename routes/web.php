<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Nhóm route cho tài khoản
Route::group([], function () {

    // Routes dành cho khách (chưa đăng nhập)
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/account/register', [AccountController::class, 'registration'])->name('account.registration');
        Route::post('/account/process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::get('/account/login', [AccountController::class, 'login'])->name('account.login');
        Route::post('/account/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
    });

    // Routes dành cho người dùng đã đăng nhập
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::post('/account/logout', [AccountController::class, 'logout'])->name('account.logout');
    });
});
