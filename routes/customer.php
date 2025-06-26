<?php

use Illuminate\Support\Facades\Route;

// Route::middleware(['auth'])->group(function () {
//     Route::get('/', function () {
//         return view('customer.home');
//     })->name('customer.home');
// });

Route::middleware(['auth'])->prefix('customer')->group(function () {
    Route::get('/home', function () {
        return view('Customer.pages.home');
    })->name('customer.home');

    Route::get('/profile', function () {
        return view('Customer.pages.profile');
    })->name('customer.profile');
});
