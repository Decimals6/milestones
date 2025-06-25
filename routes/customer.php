<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'roleOr404:customer'])->group(function () {
    Route::get('/', function () {
        return view('customer.home');
    })->name('customer.home');

    // Tambah route customer lainnya di sini
});
