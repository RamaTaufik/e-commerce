<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', [HomeController::class, 'index']);

Auth::routes();
Route::get('/register-account/{email}', [RegisterController::class, 'registerAccount'])->name('register.customer');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [HomeController::class, 'product'])->name('product');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/order', [OrderController::class, 'index'])->name('order');
Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

Route::post('/otp-request', [OtpController::class, 'requestForOtp'])->name('otp.request');
Route::post('/otp-resend', [OtpController::class, 'resendOtp'])->name('otp.resend');
Route::post('/otp-validate', [OtpController::class, 'validateOtp'])->name('otp.validate');

// ADMIN
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
Route::get('/admin/product/archive', [ProductController::class, 'archive'])->name('admin.product-archive');
Route::get('/admin/product/archiving/{id}', [ProductController::class, 'archiving'])->name('admin.product-archiving');
Route::get('/admin/product/publishing/{id}', [ProductController::class, 'publishing'])->name('admin.product-publishing');
Route::get('/admin/product/archive/{id}', [ProductController::class, 'edit'])->name('admin.product-edit');
Route::post('/admin/product/add', [ProductController::class, 'create'])->name('admin.product-create');
Route::put('/admin/product/update/{id}', [ProductController::class, 'update'])->name('admin.product-update');
Route::delete('/admin/product/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product-delete');
Route::post('/admin/product_variant/add', [ProductVariantController::class, 'create'])->name('admin.product_variant-create');
Route::put('/admin/product_variant/update/{id}', [ProductVariantController::class, 'update'])->name('admin.product_variant-update');
Route::delete('/admin/product_variant/delete/{id}', [ProductVariantController::class, 'destroy'])->name('admin.product_variant-delete');