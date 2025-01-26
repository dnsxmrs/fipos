<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\CheckKdsSource;
use App\Http\Middleware\CheckWebSource;

// webhook routes for updating products and categories - called in POS
// Route::match(['post', 'put', 'delete'], '/order-update', [APIController::class, 'updateOrder']);

// Route::match(['post', 'put', 'delete'], '/product-update', [APIController::class, 'upProduct']);

Route::middleware([CheckKdsSource::class])->group(function () {
    Route::prefix('v1')->group(function () {
        // get method for fetching orders in ordercontroller
        Route::get('/get-orders', [OrderController::class, 'getOrders']);

        // Route::match(['post', 'put', 'delete'], '/order-update', [APIController::class, 'updateOrder']);
    });
});

Route::middleware([CheckWebSource::class])->group(function () {
    Route::prefix('v1')->group(function () {

    });
});

