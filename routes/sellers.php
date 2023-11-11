<?php

use App\Http\Controllers\Sellers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Sellers\Auth\LoginWithCodeController;
use App\Http\Controllers\Sellers\Auth\NewPasswordController;
use App\Http\Controllers\Sellers\Auth\OneTimeLoginController;
use App\Http\Controllers\Sellers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Sellers\Auth\RegisteredSellerController;
use App\Http\Controllers\Sellers\Auth\SellersAuthenticatedSessionController;
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
        ->middleware(['guest']);

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

    Route::get('/login-with-code', [LoginWithCodeController::class, 'create'])
        ->middleware('guest')
        ->name('sellers.login-with-code.request');

    Route::post('/login-with-code', [LoginWithCodeController::class, 'store'])
        ->middleware(['guest', 'throttle:10,1'])
        ->name('sellers.login-with-code.send');

    Route::post('/login-with-code/confirm', [LoginWithCodeController::class, 'confirm'])
        ->middleware(['guest'])
        ->name('sellers.login-with-code.confirm');

    Route::get('/one-time-login', [OneTimeLoginController::class, 'create'])
        ->middleware(['guest'])
        ->name('sellers.one-time-login');

    Route::post('/one-time-login', [OneTimeLoginController::class, 'store'])
        ->middleware(['guest']);

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->middleware('auth')
        ->name('sellers.password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->middleware('auth:sellers');

});
