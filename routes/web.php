<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;

// Home Route -- Disable (comment out) to prevent redirecting
Route::get('/', function () {
    return redirect()->route('admin.menu.categories'); // Redirect to the categories page
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.menu.categories'); // Redirect to the categories page
    })->name('index');

    Route::get('/menu', function () {
        return redirect()->route('admin.menu.categories'); // Redirect to the categories page
    })->name('menu');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/orders', [AdminController::class, 'orders'])->name('order-tracking');
    Route::get('/staff', [AdminController::class, 'staff'])->name('staff-management');
    Route::get('/audit', [AdminController::class, 'audit'])->name('audit-trails');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

    // Menu Management Routes
    Route::prefix('menu')->name('menu.')->group(function () {
        // Route to display the categories and products
        Route::get('/categories', [MenuController::class, 'categories'])->name('categories');
        Route::get('/products', [MenuController::class, 'products'])->name('products');

        // Route to store a new category
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        // Route to update a category
        Route::put('/categories', [CategoryController::class, 'update'])->name('categories.update');
        // Route to delete a category
        Route::delete('/categories/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

        // Route to store a new product
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        // Route to update a product
        Route::put('/products', [ProductController::class, 'update'])->name('products.update');
        // Route to delete a product
        Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('products.delete');
    });
});

// Authentication Routes
require __DIR__ . '/auth.php';
