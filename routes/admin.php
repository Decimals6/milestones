<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardControllerAdmin;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\CategoryItemController;
use App\Http\Controllers\Admin\FoodItemController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\StatisticController;

// Middleware: hanya user yang login + role admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardControllerAdmin::class, 'index'])->name('dashboard');

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Menu Management: Foods
    Route::get('/foods', [FoodController::class, 'index'])->name('foods.index');
    Route::get('/foods/create', [FoodController::class, 'create'])->name('foods.create');
    Route::post('/foods', [FoodController::class, 'store'])->name('foods.store');
    Route::get('/foods/edit/{id}', [FoodController::class, 'edit'])->name('foods.edit');
    Route::put('/foods/{id}', [FoodController::class, 'update'])->name('foods.update');
    Route::delete('/foods/{id}', [FoodController::class, 'destroy'])->name('foods.destroy');

    // Category Items
    Route::resource('category-items', CategoryItemController::class)->names('categories');

    // Food Options
    Route::resource('food-options', FoodItemController::class)->names('food_options');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    // Reports
    Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
});
