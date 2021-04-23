<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\CustomerController;

Route::get('/', [App\Http\Controllers\WebController::class, 'home'])->name('home');

Route::prefix('/')->group(function () {
    Route::get('carrinho', [App\Http\Controllers\WebController::class, 'cart'])->name('cart');
    Route::get('produto/{slug}', [App\Http\Controllers\WebController::class, 'productDetails'])->name('product');
    Route::post('produto/adicionar-carrinho', [App\Http\Controllers\WebController::class, 'addCart'])->name('add-cart');
});

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::resource('produtos', ProductController::class);
    Route::resource('categorias', CategoryController::class);
    Route::resource('categorias-produtos', ProductCategoryController::class);
    Route::resource('fabricantes', ManufacturerController::class);
    Route::resource('clientes', CustomerController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
