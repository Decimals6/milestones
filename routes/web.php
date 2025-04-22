<?php

use App\Http\Controllers\Admin\CategoryItemControllerAdmin;
use App\Http\Controllers\Admin\FoodControllerAdmin;
use Illuminate\Support\Facades\Route;

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

// Dashboard
Route::get('/admin', function () {
    return view('admin.page.dashboard');
})->name('admin.dashboard');

// Food admin
Route::get('/admin/foods', [FoodControllerAdmin::class, 'index'])->name('admin.food.index');
Route::post('/admin/foods', [FoodControllerAdmin::class, 'store'])->name('admin.food.store');

// Category admin
Route::get('/admin/category', [CategoryItemControllerAdmin::class, 'index'])->name('admin.category.index');
