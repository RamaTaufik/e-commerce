<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;

Route::get('/', function() {
    return redirect()->route('home');
});

Auth::routes();
Route::get('/register-account/{email}', [RegisterController::class, 'registerAccount'])->name('register.customer');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/product/{id}', [HomeController::class, 'product'])->name('product');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile-update');
Route::post('/profile/address/add', [ProfileController::class, 'addressAdd'])->name('profile-address-add');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/order/get-district', [OrderController::class, 'getDistrict'])->name('order.get-district');
Route::post('/order/check-ongkir', [OrderController::class, 'checkOngkir'])->name('order.check-ongkir');
Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::post('/order/buy', [OrderController::class, 'buy'])->name('order.buy');
Route::get('/order/tracking', [OrderController::class, 'tracking'])->name('order.tracking');
Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
Route::post('/order/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
Route::post('/order/cancel', [OrderController::class, 'cancel'])->name('order.cancel');

Route::post('/order/review', [ReviewController::class, 'add'])->name('review.add');

Route::post('/otp-request', [OtpController::class, 'requestForOtp'])->name('otp.request');
Route::post('/otp-resend', [OtpController::class, 'resendOtp'])->name('otp.resend');
Route::post('/otp-validate', [OtpController::class, 'validateOtp'])->name('otp.validate');

// ADMIN
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/order', [AdminOrderController::class, 'index'])->name('admin.order');
Route::get('/admin/order/shipment', [AdminOrderController::class, 'shipment'])->name('admin.order-shipment');
Route::get('/admin/order/ship/{id}', [AdminOrderController::class, 'ship'])->name('admin.order-ship');
Route::get('/admin/order/arrived/{id}', [AdminOrderController::class, 'arrived'])->name('admin.order-arrived');
Route::get('/admin/order/cancelled', [AdminOrderController::class, 'cancelled'])->name('admin.order-cancelled');
Route::get('/admin/order/resend/{order}', [AdminOrderController::class, 'resend'])->name('admin.order-resend');
Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
Route::get('/admin/product/archive', [ProductController::class, 'archive'])->name('admin.product-archive');
Route::get('/admin/product/archiving/{id}', [ProductController::class, 'archiving'])->name('admin.product-archiving');
Route::get('/admin/product/publishing/{id}', [ProductController::class, 'publishing'])->name('admin.product-publishing');
Route::get('/admin/product/archive/{id}', [ProductController::class, 'edit'])->name('admin.product-edit');
Route::post('/admin/product/add', [ProductController::class, 'create'])->name('admin.product-create');
Route::put('/admin/product/update/{id}', [ProductController::class, 'update'])->name('admin.product-update');
Route::delete('/admin/product/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product-delete');
Route::post('/admin/product_variant/add', 'App\Http\Controllers\ProductVariantController@create')->name('admin.product_variant-create');
Route::put('/admin/product_variant/update/{id}', [ProductVariantController::class, 'update'])->name('admin.product_variant-update');
Route::delete('/admin/product_variant/delete/{id}', [ProductVariantController::class, 'destroy'])->name('admin.product_variant-delete');
Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customers');
Route::get('/admin/customers/edit/{id}', [CustomerController::class, 'edit'])->name('admin.customers-edit');
Route::put('/admin/customers/update/{id}', [CustomerController::class, 'update'])->name('admin.customers-update');
Route::delete('/admin/customers/delete/{id}', [CustomerController::class, 'destroy'])->name('admin.customers-delete');
Route::get('/admin/report', [AdminController::class, 'report'])->name('admin.report');
