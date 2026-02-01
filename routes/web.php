<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Web\AdvertisementController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\UserProductController;
use Illuminate\Support\Facades\Route;

Route::redirect('/','/products')->name('home');

// Language switching
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');


Route::get('/dashboard', [UserProductController::class,'index'])->middleware(['auth', 'verified','activated'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('products')->group(function(){
    Route::get('/',[ProductController::class,'index'])->name('products.index');
    Route::get('/create',[UserProductController::class,'create'])->middleware(['auth','activated'])->name('products.create');
    Route::post('/',[UserProductController::class,'store'])->name('products.store');
    Route::get('/{product}',[ProductController::class,'show'])->name('products.show');
    Route::get('/{product}/edit',[UserProductController::class,'edit'])->middleware(['auth','can:edit,product','activated'])->name('products.edit');
    Route::patch('/{product}',[UserProductController::class,'update'])->middleware(['auth','can:edit,product','activated'])->name('products.update');
    Route::delete('/{product}',[UserProductController::class,'destroy'])->middleware(['auth','can:destroy,product','activated'])->name('products.destroy');
    Route::get('/serach',[ProductController::class,'search']);

    Route::get('/my-products',[UserProductController::class,'index'])->middleware(['auth','activated'])->name('products.my');
});

Route::get('products/suggestions/{field}', [ProductController::class, 'suggestions']);



Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::middleware('guest:admin')->group(function(){
        // Redirect admin login to user login page
        Route::get('login', [AuthController::class, 'index'])->name('login');
        // Admin login is now handled through the main login route
    });

    Route::middleware('auth:admin')->group(function () {
        Route::patch('/products/bulk-toggle', [AdminProductController::class, 'bulkToggle'])
            ->name('products.bulk-toggle');

        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::patch('/products/{product}/toggle',
            [AdminProductController::class, 'toggle'])
            ->name('products.toggle');

        Route::delete('/products/{product}',
            [AdminProductController::class, 'destroy'])
            ->name('products.destroy');

        Route::get('/users', [AdminUserController::class, 'index'])
                ->name('users.index');
    
        Route::patch('/users/{user}/toggle',[AdminUserController::class, 'toggle'])
                ->name('users.toggle');
    
        Route::get('/users/{user}',[AdminUserController::class, 'show'])
                ->name('users.show');

        Route::resource('/advertisements',AdvertisementController::class)->except('show');
    });
    
    
    
});
Route::get('ads/{advertisement}',[AdvertisementController::class,'show'])->name('ads.click');







require __DIR__.'/auth.php';
