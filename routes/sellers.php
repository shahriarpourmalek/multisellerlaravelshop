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
use App\Http\Controllers\Sellers\Dashboard\SellersCommentController;
use App\Http\Controllers\Sellers\Dashboard\SellersOrderController;
use App\Http\Controllers\Sellers\Dashboard\SellersProductController;
use App\Http\Controllers\Sellers\Dashboard\SellersReviewController;
use App\Http\Controllers\Sellers\Dashboard\SellersStatisticsController;
use App\Http\Controllers\Sellers\Dashboard\SellersTransactionController;
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


    // ------------------ MainController
    Route::get('get-tags', [MainController::class, 'get_tags'])->name('sellers.get-tags');
    Route::get('get-labels', [MainController::class, 'getLabels'])->name('sellers.get-labels');

    Route::get('notifications', [MainController::class, 'notifications'])->name('sellers.notifications');

    Route::get('file-manager', [MainController::class, 'fileManager'])->name('sellers.file-manager');
    Route::get('file-manager-iframe', [MainController::class, 'fileManagerIframe'])->name('sellers.file-manager-iframe');
    // ------------------ orders
    Route::resource('orders', SellersOrderController::class);
    Route::post('orders/api/shippings-status', [SellersOrderController::class, 'shippingsStatus'])->name('sellers.orders.shippings-status');
    Route::post('orders/{order}/shipping-status', [SellersOrderController::class, 'shipping_status'])->name('sellers.orders.shipping-status');
    Route::get('orders/{order}/print', [SellersOrderController::class, 'print'])->name('sellers.orders.print');
    Route::get('orders/{order}/shipping-form', [SellersOrderController::class, 'shippingForm'])->name('sellers.orders.shipping-form');
    Route::post('orders/api/index', [SellersOrderController::class, 'apiIndex'])->name('sellers.orders.apiIndex');
    Route::delete('orders/api/multipleDestroy', [SellersOrderController::class, 'multipleDestroy'])->name('sellers.orders.multipleDestroy');
    Route::get('order/not-completed/products', [SellersOrderController::class, 'notCompleted'])->name('sellers.orders.notCompleted');
    Route::get('orders/api/userInfo', [SellersOrderController::class, 'userInfo'])->name('sellers.orders.userInfo');
    Route::get('orders/api/productsList', [SellersOrderController::class, 'productsList'])->name('sellers.orders.productsList');
    Route::get('orders/api/printAllShippingForms', [SellersOrderController::class, 'printAllShippingForms'])->name('sellers.orders.printAllShippingForms');
    Route::get('orders/api/printAll', [SellersOrderController::class, 'printAll'])->name('sellers.orders.printAll');

    Route::get('orders/export/create', [SellersOrderController::class, 'export'])->name('sellers.orders.export');

    // ------------------ statistics
//    Route::get('statistics/viewsList', [SellersStatisticsController::class, 'viewsList'])->name('sellers.statistics.viewsList');
    Route::get('statistics/views', [SellersStatisticsController::class, 'views'])->name('sellers.statistics.views');
    Route::get('statistics/viewCounts', [SellersStatisticsController::class, 'viewCounts'])->name('sellers.statistics.viewCounts');
    Route::get('statistics/viewerCounts', [SellersStatisticsController::class, 'viewerCounts'])->name('sellers.statistics.viewerCounts');
//    Route::get('statistics/viewers', [SellersStatisticsController::class, 'viewers'])->name('sellers.statistics.viewers');

    Route::get('statistics/orders', [SellersStatisticsController::class, 'orders'])->name('sellers.statistics.orders');
    Route::get('statistics/orderValues', [SellersStatisticsController::class, 'orderValues'])->name('sellers.statistics.orderValues');
    Route::get('statistics/orderCounts', [SellersStatisticsController::class, 'orderCounts'])->name('sellers.statistics.orderCounts');
    Route::get('statistics/orderUsers', [SellersStatisticsController::class, 'orderUsers'])->name('sellers.statistics.orderUsers');
    Route::get('statistics/orderProducts', [SellersStatisticsController::class, 'orderProducts'])->name('sellers.statistics.orderProducts');

    Route::get('statistics/users', [SellersStatisticsController::class, 'users'])->name('sellers.statistics.users');
    Route::get('statistics/userCounts', [SellersStatisticsController::class, 'userCounts'])->name('sellers.statistics.userCounts');

//    Route::get('statistics/smsLog', [SellersStatisticsController::class, 'smsLog'])->name('sellers.statistics.smsLog');


    // ------------------ transactions
    Route::resource('transactions', SellersTransactionController::class)->only(['index', 'show', 'destroy']);
    Route::post('transactions/api/index', [SellersTransactionController::class, 'apiIndex'])->name('sellers.transactions.apiIndex');
    Route::delete('transactions/api/multipleDestroy', [SellersTransactionController::class, 'multipleDestroy'])->name('sellers.transactions.multipleDestroy');


    // ------------------ comments
    Route::resource('comments', SellersCommentController::class)->only(['show', 'destroy', 'update']);
    Route::get('comments/index/products', [SellersCommentController::class, 'productComments'])->name('sellers.comments.products');

    // ------------------ reviews
    Route::resource('reviews', SellersReviewController::class)->only(['index', 'show', 'destroy', 'update']);

});

