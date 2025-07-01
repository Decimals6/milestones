<?php

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CategoryController;
use App\Http\Controllers\Customer\FoodController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\MenuController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->prefix('customer')->group(function () {
    Route::resource('/home', HomeController::class);

    Route::resource('/menu', MenuController::class);

    Route::resource('/category', CategoryController::class);

    Route::get('/foods/{id}/details', [FoodController::class, 'getDetails'])->name('foods.details');

    Route::resource('/cart', CartController::class)->only(['index', 'store']);
    Route::controller(CartController::class)->group(function () {
        Route::post('cart/update', 'update')->name('cart.update');
        Route::delete('cart/remove', 'remove')->name('cart.remove');
        Route::delete('cart/clear', 'clear')->name('cart.clear');
    });

    Route::get('/profile', function () {
        return view('Customer.pages.profile');
    })->name('customer.profile');

    Route::get('/like', function () {
        return view('Customer.pages.like');
    })->name('like');

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

    Route::delete('/customer/delete-account', function () {
        // Dummy response
        return back()->with('status', 'Dummy: Account deleted (simulasi).');
    })->name('customer.delete-account');
});
