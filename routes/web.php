<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::get('/register-account/{email}', [\App\Http\Controllers\Auth\RegisterController::class, 'registerAccount'])->name('register.customer');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/otp-request', [\App\Http\Controllers\OtpController::class, 'requestForOtp'])->name('otp.request');
Route::post('/otp-resend', [\App\Http\Controllers\OtpController::class, 'resendOtp'])->name('otp.resend');
Route::post('/otp-validate', [\App\Http\Controllers\OtpController::class, 'validateOtp'])->name('otp.validate');

// ADMIN
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');