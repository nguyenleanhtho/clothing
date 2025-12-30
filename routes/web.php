<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Client\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('client.index');
Route::get('/about', [HomeController::class, 'about'])->name('client.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('client.contact');
Route::get('/products', [HomeController::class, 'products'])->name('client.products');

Route::post('/logout', function () {
    return redirect()->route('client.index');
})->name('logout');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('client.product.detail');
Route::get('/cart', [CartController::class, 'index'])->name('client.cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('client.cart.add');
Route::get('/login', function () { return view('client.auth.login'); })->name('login');
Route::get('/register', function () { return view('client.auth.register'); })->name('register');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('client.product.detail');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/products', function () {
        return view('admin.products.index');
    })->name('products.index');

    Route::get('/products/create', function () {
        return view('admin.products.create');
    })->name('products.create');

    Route::post('/products', function () {
        return "Submit form success";
    })->name('products.store');
});