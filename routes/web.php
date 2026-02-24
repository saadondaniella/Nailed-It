<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', [CategoryController::class, 'index']);

Route::resource('products', ProductController::class);
