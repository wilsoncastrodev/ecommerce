<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::prefix('/')->group(function () {
    Route::get('', [WebController::class, 'home'])->name('home');
    Route::get('carrinho', [WebController::class, 'cart'])->name('cart');
    Route::get('produto/{slug}', [WebController::class, 'productDetails'])->name('product');
    Route::post('produto/adicionar-carrinho', [WebController::class, 'addCart'])->name('add-cart');
});

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('produtos', ProductController::class);
    Route::resource('categorias', CategoryController::class);
    Route::resource('categorias-produtos', ProductCategoryController::class);
    Route::resource('fabricantes', ManufacturerController::class);
    Route::resource('clientes', CustomerController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::get('/register', [RegisterController::class, 'register']);
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::get('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::get('/password/reset', [ResetPasswordController::class, 'reset']);
});
