<?php

use App\Http\Controllers\Admin\FoodController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'roleOr404:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    Route::resource('foods', FoodController::class);
});
