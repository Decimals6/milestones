<?php

use App\Http\Controllers\Customer\CategoryController;
use App\Http\Controllers\Customer\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('customer')->group(function () {
    Route::resource('/home', HomeController::class);

    Route::resource('/category', CategoryController::class);

    Route::get('/profile', function () {
        return view('Customer.pages.profile');
    })->name('customer.profile');

    Route::get('/like', function () {
        return view('Customer.pages.like');
    })->name('like');

    Route::get('/cart', function () {
        return view('Customer.pages.cart');
    })->name('cart');

    Route::get('/wallet', function () {
        return view('Customer.pages.wallet');
    })->name('wallet');

    Route::get('/orders', function () {
        return view('Customer.pages.orders');
    })->name('orders');

    Route::get('/refer', function () {
        return view('Customer.pages.refer');
    })->name('refer');

    Route::get('/notifications', function () {
        return view('Customer.pages.notifications');
    })->name('notifications');

    Route::get('/coupons', function () {
        return view('Customer.pages.coupons');
    })->name('coupons');

    Route::get('/loyalty', function () {
        return view('Customer.pages.loyalty');
    })->name('loyalty');

    Route::get('/checkout', function () {
        return view('Customer.pages.checkout');
    })->name('checkout');

    Route::get('/track', function () {
        return view('Customer.pages.track');
    })->name('track');

    Route::get('/reviews', function () {
        return view('Customer.pages.reviews');
    })->name('reviews');

    Route::get('/discover', function () {
        return view('Customer.pages.discover');
    })->name('discover');

    Route::get('/menu', function () {
        return view('Customer.pages.menu');
    })->name('menu');
});
