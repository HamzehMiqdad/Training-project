<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserProductController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'store'])->name('api.register');
Route::post('/login', [AuthController::class, 'store'])->name('api.login');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('api.products.index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('api.products.show');
    Route::get('/suggestions/{field}', [ProductController::class, 'suggestions'])->name('api.products.suggestions');

    Route::middleware(['auth:sanctum', 'activated'])->group(function () {
        Route::post('/', [UserProductController::class, 'store'])->name('api.products.store');
        Route::patch('/{product}', [UserProductController::class, 'update'])->middleware('can:edit,product')->name('api.products.update');
        Route::delete('/{product}', [UserProductController::class, 'destroy'])->middleware('can:destroy,product')->name('api.products.destroy');
        Route::get('/my-products', [UserProductController::class, 'index'])->name('api.products.my');
    });
});

Route::middleware(['auth:sanctum', 'activated'])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('api.logout');
    Route::get('/user', [AuthController::class, 'user'])->name('api.user');

    Route::get('/dashboard', [UserProductController::class, 'index'])->name('api.dashboard');


    Route::get('/profile', [ProfileController::class, 'show'])->name('api.profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('api.profile.update');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('api.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('api.profile.destroy');
});

