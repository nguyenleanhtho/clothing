<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// Client routes
Route::get('/', [HomeController::class, 'index'])->name('client.index');
Route::get('/about', [HomeController::class, 'about'])->name('client.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('client.contact');
Route::get('/products', [HomeController::class, 'products'])->name('client.products');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('client.product.detail');

// Auth routes (đơn giản)
Route::get('/login', function () { return view('client.auth.login'); })->name('login');
Route::get('/register', function () { return view('client.auth.register'); })->name('register');
Route::post('/logout', function () {
    return redirect()->route('client.index');
})->name('logout');

// Cart routes (nếu cần)
Route::get('/cart', [CartController::class, 'index'])->name('client.cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('client.cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('client.cart.remove');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Category routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    // Product routes
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');
});