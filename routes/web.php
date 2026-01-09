<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CartController;

Route::get('/', [HomeController::class, 'index'])->name('client.index');
Route::get('/about', [HomeController::class, 'about'])->name('client.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('client.contact');
Route::get('/products', [ProductController::class, 'index'])->name('client.products');

// Route::post('/logout', function () {
//     return redirect()->route('client.index');
// })->name('logout');


Route::get('/cart', [CartController::class, 'index'])->name('client.cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('client.cart.add');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('client.product.detail');

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