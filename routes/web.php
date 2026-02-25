<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', [CategoryController::class, 'index']);

// Dashboard routes
Route::get('/dashboard', [CategoryController::class, 'dashboard'])->name('dashboard.index');
Route::get('/dashboard/categories/{category}', [CategoryController::class, 'show'])->name('dashboard.show');

Route::resource('products', ProductController::class);
