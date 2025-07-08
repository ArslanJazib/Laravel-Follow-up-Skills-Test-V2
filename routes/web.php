<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('products-data', [ProductController::class, 'data'])->name('products.data');
    Route::resource('products', ProductController::class);
});
