<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\CheckKdsSource;
use App\Http\Middleware\CheckWebSource;

Route::middleware([CheckKdsSource::class])->group(function () {
    Route::prefix('v1')->group(function () {
        // get method for fetching orders in ordercontroller
        Route::get('/get-orders', [OrderController::class, 'getOrders']);
        // used for updating status from kds to pos (pos orders)
        Route::post('/status-update', [APIController::class, 'statusUpdate']);
        // used for updating status from kds to web (web orders)
        Route::post('/status-update-web', [APIController::class, 'statusUpdateWeb']);

        // Route::match(['post', 'put', 'delete'], '/order-update', [APIController::class, 'updateOrder']);
    });
});

Route::middleware([CheckWebSource::class])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::post('/push-order', [APIController::class, 'ordersFromWeb']);

        Route::post('/cancel-order', [APIController::class, 'cancelOrder']);
    });
});


Route::get('/sales-data', [AdminController::class, 'getSalesData']);
