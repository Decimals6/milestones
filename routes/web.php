<?php

use App\Http\Controllers\Admin\CategoryItemControllerAdmin;
use App\Http\Controllers\Admin\FoodControllerAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderControllerAdmin;
use App\Http\Controllers\Admin\DashboardControllerAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Statistik
Route::get('admin/dashboard', [DashboardControllerAdmin::class,'index'])
     ->name('admin.dashboard');

// Food admin
Route::get('/admin/foods', [FoodControllerAdmin::class, 'index'])->name('admin.food.index');
Route::post('/admin/foods', [FoodControllerAdmin::class, 'store'])->name('admin.food.store');
Route::get('admin/food/create', [FoodControllerAdmin::class,'create'])
     ->name('admin.food.create');

// Category admin
Route::get('/admin/category', [CategoryItemControllerAdmin::class, 'index'])->name('admin.category.index');
Route::post('admin/category', [CategoryItemControllerAdmin::class,'store'])
     ->name('admin.category.store');

Route::get('admin/category/create', [CategoryItemControllerAdmin::class,'create'])
     ->name('admin.category.create');

// Order Management
Route::get('admin/orders', [OrderControllerAdmin::class,'index'])
     ->name('admin.orders.index');

Route::get('admin/orders/{order}', [OrderControllerAdmin::class,'show'])
     ->name('admin.orders.show');
