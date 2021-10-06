<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::prefix('/')->group(function () {
    Route::get('', [WebController::class, 'home'])->name('home');
    Route::get('carrinho', [WebController::class, 'showCart'])->name('cart');
    Route::get('categoria/{slug}', [WebController::class, 'showCategory'])->name('category');
    Route::post('categoria', [WebController::class, 'loadMoreCategory'])->name('load-more-category');
    Route::get('pesquisa', [WebController::class, 'search'])->name('search-products');
    Route::post('pesquisa', [WebController::class, 'loadMoreSearch'])->name('load-more-search');
    Route::get('pesquisa-rapida/{keywords?}', [WebController::class, 'quickSearchProducts'])->name('quick-search-products');
    Route::get('pagamento', [WebController::class, 'showCheckout'])->name('checkout')->middleware('auth:customer');
    Route::post('pagamento', [WebController::class, 'createOrder'])->name('create-order')->middleware('auth:customer');
    Route::get('produto/{slug}', [WebController::class, 'productDetails'])->name('product');
    Route::post('produto/frete', [WebController::class, 'checkShipping'])->name('check-shipping');
    Route::post('produto/atualizar-quantidade', [WebController::class, 'updateQuantity'])->name('update-quantity');
    Route::post('produto/adicionar-carrinho', [WebController::class, 'addCart'])->name('add-cart');
    Route::post('produto/remover-produto', [WebController::class, 'deleteProduct'])->name('delete-product');
    Route::post('produto/avaliar-produto', [WebController::class, 'storeReviewProduct'])->name('store-review-product');
    Route::post('registro/validar-cliente', [RegisterController::class, 'validatorCustomer'])->name('register-validate');
});

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('produtos', ProductController::class);
    Route::resource('categorias', CategoryController::class);
    Route::resource('subcategory', ProductCategoryController::class);
    Route::resource('fabricantes', ManufacturerController::class);
    Route::resource('clientes', CustomerController::class);
    Route::resource('usuarios', UserController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
});

Route::prefix('/')->group(function () {
    Route::get('login', [LoginController::class, 'showCustomerLoginForm'])->name('form.customer.login');
    Route::post('produto/login-review')->name('login-review')->middleware('auth:customer');
    Route::post('logout', [LoginController::class, 'logout'])->name('customer.logout');
    Route::get('register', [RegisterController::class, 'showCustomerRegisterForm'])->name('form.customer.register');
    Route::post('login', [LoginController::class, 'customerLogin'])->name('customer.login');
    Route::post('register', [RegisterController::class, 'createCustomer'])->name('customer.register');
});
