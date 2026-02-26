<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Login routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected dashboard and product routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CategoryController::class, 'dashboard'])->name('dashboard.index');
    Route::get('/dashboard/categories/{category}', [CategoryController::class, 'show'])->name('dashboard.show');

    Route::resource('products', ProductController::class);
});
