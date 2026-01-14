<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [HomeController::class, 'index'])->name('client.index');
Route::get('/about', [HomeController::class, 'about'])->name('client.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('client.contact');
Route::get('/products', [ClientProductController::class, 'index'])->name('client.products');

// Route::post('/logout', function () {
//     return redirect()->route('client.index');
// })->name('logout');


Route::get('/cart', [CartController::class, 'index'])->name('client.cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('client.cart.add');


//Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
//Route::post('/login', [AuthController::class, 'login']);

//Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
//Route::post('/register', [AuthController::class, 'register']);

//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/product/{id}', [ClientProductController::class, 'detail'])->name('client.product.detail');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::post('/products', function () {
        return "Submit form success";
    })->name('products.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Route cập nhật số lượng (dùng PATCH)
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('client.cart.update');
    // Route xóa sản phẩm (dùng DELETE)
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('client.cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('client.checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('client.checkout.process');

    Route::get('/my-orders', [ClientOrderController::class, 'index'])->name('client.orders.index');
});

Route::middleware('auth', 'role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', AdminOrderController::class);
});

require __DIR__.'/auth.php';