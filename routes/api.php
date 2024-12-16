<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

// webhook routes for updating products and categories - called in POS
Route::match(['post', 'put', 'delete'], '/order-update', [APIController::class, 'updateOrder']);

Route::match(['post', 'put', 'delete'], '/product-update', [APIController::class, 'upProduct']);



