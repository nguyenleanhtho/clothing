<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('client.index');
Route::get('/about', [HomeController::class, 'about'])->name('client.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('client.contact');
Route::get('/products', [HomeController::class, 'products'])->name('client.products');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
