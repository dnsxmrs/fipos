<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;

// Home Route
Route::get('/', function () {
    return view('layouts.admin-layout');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/menu', [AdminController::class, 'menu'])->name('menu');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/orders', [AdminController::class, 'orders'])->name('order-tracking');
    Route::get('/staff', [AdminController::class, 'staff'])->name('staff-management');
    Route::get('/audit', [AdminController::class, 'audit'])->name('audit-trails');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

    // Menu Management Routes
    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('/categories', [MenuController::class, 'categories'])->name('categories');
        Route::get('/products', [MenuController::class, 'products'])->name('products');

        // Route to store a new product
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    });
});


// Product Management Routes (Static Views)
Route::prefix('product-management')->name('product.')->group(function () {
    Route::view('/header', 'product-management.product-header')->name('header');
    Route::view('/view', 'product-management.product-view')->name('view');
    Route::view('/create', 'product-management.product-create')->name('create');
    Route::view('/update', 'product-management.product-update')->name('update');
    Route::view('/delete', 'product-management.product-delete')->name('delete');
});

// Category Management Routes (Static Views)
Route::prefix('category-management')->name('category.')->group(function () {
    Route::view('/view', 'category-management.category-view')->name('view');
    Route::view('/add', 'category-management.category-add')->name('add');
    Route::view('/edit', 'category-management.modal-edit')->name('edit');
    Route::view('/delete', 'category-management.modal-delete')->name('delete');
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Route
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Category Routes
    Route::resource('categories', CategoryController::class)->names('categories');

    // Product Routes
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/search', [ProductController::class, 'search'])->name('search');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}', [ProductController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });
});

// Authentication Routes
require __DIR__ . '/auth.php';
