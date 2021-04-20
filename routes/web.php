<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::name('admin.')->prefix('admin')->group(function () {
    Route::resource('produtos', ProductController::class);
    Route::resource('categorias', CategoryController::class);
    Route::resource('categorias-produtos', ProductCategoryController::class);
    Route::resource('fabricantes', ManufacturerController::class);
    Route::resource('clientes', CustomerController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
