<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Nhóm route cho tài khoản
Route::group(['prefix' => 'account'], function () {

    // Routes dành cho khách (chưa đăng nhập)
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [AccountController::class, 'registration'])->name('account.registration');
        Route::post('/process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::get('/login', [AccountController::class, 'login'])->name('account.login');
        Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
    });

    // Routes dành cho người dùng đã đăng nhập
        Route::group(['middleware' => 'auth'], function () {
        Route::get('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::post('/logout', [AccountController::class, 'logout'])->name('account.logout');
    });
});
