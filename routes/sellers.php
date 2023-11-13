<?php

use App\Http\Controllers\Sellers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Sellers\Auth\LoginWithCodeController;
use App\Http\Controllers\Sellers\Auth\NewPasswordController;
use App\Http\Controllers\Sellers\Auth\OneTimeLoginController;
use App\Http\Controllers\Sellers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Sellers\Auth\RegisteredSellerController;
use App\Http\Controllers\Sellers\Auth\SellersAuthenticatedSessionController;
use App\Http\Controllers\Sellers\Dashboard\Maincontroller;
use App\Http\Controllers\Sellers\Dashboard\ProductController;
use App\Http\Controllers\Sellers\Dashboard\SellerController;
use App\Http\Controllers\Sellers\Dashboard\SellersProductController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'sellers'], function () {

    Route::get('/register', [RegisteredSellerController::class, 'create'])
        ->middleware(['guest'])
        ->name('sellers.register');

    Route::post('/register', [RegisteredSellerController::class, 'store'])
        ->middleware(['guest'])
        ->name('sellers.register');

    Route::get('/login', [SellersAuthenticatedSessionController::class, 'create'])
        ->middleware(['guest'])
        ->name('sellers.login');

    Route::post('/login', [SellersAuthenticatedSessionController::class, 'store'])
        ->middleware(['guest'])->name('sellers.login');

    Route::post('/logout', [SellersAuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:sellers');

    Route::get('/logout', [SellersAuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:sellers')
        ->name('sellers.logout');

    Route::get('/change-password', [NewPasswordController::class, 'show'])
        ->middleware(['auth:sellers', 'EnsureForceChange'])
        ->name('sellers.change-password');

    Route::post('/change-password', [NewPasswordController::class, 'store'])
        ->middleware(['auth:sellers', 'EnsureForceChange']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->middleware('guest')
        ->name('sellers.password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware(['guest', 'throttle:10,1'])
        ->name('sellers.password.send');

//    Route::get('/login-with-code', [LoginWithCodeController::class, 'create'])
//        ->middleware('guest')
//        ->name('sellers.login-with-code.request');
//
//    Route::post('/login-with-code', [LoginWithCodeController::class, 'store'])
//        ->middleware(['guest', 'throttle:10,1'])
//        ->name('sellers.login-with-code.send');
//
//    Route::post('/login-with-code/confirm', [LoginWithCodeController::class, 'confirm'])
//        ->middleware(['guest'])
//        ->name('sellers.login-with-code.confirm');
//
//    Route::get('/one-time-login', [OneTimeLoginController::class, 'create'])
//        ->middleware(['guest'])
//        ->name('sellers.one-time-login');
//
//    Route::post('/one-time-login', [OneTimeLoginController::class, 'store'])
//        ->middleware(['guest']);
//
//    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
//        ->middleware('auth')
//        ->name('sellers.password.confirm');
//
//    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
//        ->middleware('auth:sellers');

});

Route::group([ 'prefix' => 'sellers/' , 'middleware' => 'auth:sellers'], function () {
    Route::get('/', [MainController::class, 'index'])->name('sellers.dashboard');
    Route::get('/profile', [SellerController::class, 'showProfile'])->name('sellers.profile.show');
    Route::put('/profile', [SellerController::class, 'updateProfile'])->name('sellers.profile.update');
    // ------------------ products
    Route::resource('products', SellersProductController::class)->except('show');
    Route::post('products/api/index', [SellersProductController::class, 'apiIndex'])->name('sellers.products.apiIndex');
    Route::delete('products/api/multipleDestroy', [SellersProductController::class, 'multipleDestroy'])->name('sellers.products.multipleDestroy');
    Route::post('products/image-store', [SellersProductController::class, 'image_store']);
    Route::post('products/image-delete', [SellersProductController::class, 'image_delete']);
    Route::get('product/categories', [SellersProductController::class, 'categories'])->name('sellers.products.categories.index');
    Route::post('product/slug', [SellersProductController::class, 'generate_slug']);

    Route::get('products/export/create', [SellersProductController::class, 'export'])->name('sellers.products.export');

    Route::get('product/prices', [SellersProductController::class, 'indexPrices'])->name('sellers.product.prices.index');
    Route::put('product/prices', [SellersProductController::class, 'updatePrices'])->name('sellers.product.prices.update');

});

