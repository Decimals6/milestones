<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;

// --------------------------------------------------
// GUEST ROUTES (tanpa login): login, register, reset password
// --------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store']);

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login/forgot-password', [ResetController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ResetController::class, 'sendEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});


// --------------------------------------------------
// AUTH ROUTES (user yang sudah login, baik admin maupun customer)
// --------------------------------------------------
Route::middleware('auth')->group(function () {

    // Homepage
    Route::get('/', [HomeController::class, 'home'])->name('home');

    // Halaman umum yang bisa diakses semua user
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard'); // default fallback
    Route::get('/billing', fn () => view('admin.billing'))->name('billing');
    Route::get('/profile', fn () => view('admin.profile'))->name('profile');

    // Update Profile
    Route::get('/user-profile', [InfoUserController::class, 'create'])->name('profile.edit');
    Route::post('/user-profile', [InfoUserController::class, 'store'])->name('profile.update');

    // Menu pelanggan (nanti ajg)
    Route::get('/menu', fn () => view('customer.menu'))->name('menu');

    // Logout
    Route::get('/logout', [SessionsController::class, 'destroy'])->name('logout');
});
