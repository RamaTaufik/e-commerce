<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::get('/register-account/{email}', [RegisterController::class, 'registerAccount'])->name('register.customer');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/otp-request', [OtpController::class, 'requestForOtp'])->name('otp.request');
Route::post('/otp-resend', [OtpController::class, 'resendOtp'])->name('otp.resend');
Route::post('/otp-validate', [OtpController::class, 'validateOtp'])->name('otp.validate');

// ADMIN
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
Route::get('/admin/product/archive', [ProductController::class, 'archive'])->name('admin.product-archive');
Route::post('/admin/product/add', [ProductController::class, 'create'])->name('admin.product-create');
Route::get('/admin/product/archive/{id}', [ProductController::class, 'edit'])->name('admin.product-edit');