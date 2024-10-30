<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;


// only authenticated users can access these pages
Route::middleware(['auth'])->group(function () {
    Route::view('/logout-confirm', 'auth.logout-modal')->name('logout.confirm');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::view('/cashier-page', 'cashier.cashier-main')->name('cashier.page');
});

// only authenticated users and admin can access this page
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('/add-user', 'user management.add-user')->name('add.user');
    Route::post('/add-user', [AuthController::class, 'add']);
    Route::view('/order-management', 'admin.order-management')->name('order.management');
    Route::view('/edit-profile', 'user management.edit-profile')->name('update.profile');
    Route::post('/edit-profile', [ProfileController::class, 'updateProfile']);
    Route::view('/success-add-user', 'user management.success-add')->name('success.add.user');
    Route::view('/success-update-profile', 'user management.success-edit')->name('success.update.profile');
    Route::get('/change-password', [ResetPasswordController::class, 'changePasswordView'])->name('change.password');
    Route::post('/change-password', [ResetPasswordController::class, 'changePassword'])->name('change.password');
    Route::view('/success-change-password', 'password.change-auth.success-change')->name('success.change.password');
    Route::view('/list-user', 'user management.list-user')->name('list.user');
    Route::get('/users', [UserController::class, 'display'])->name('users.index');
});

// only guests can access these pages
Route::middleware(['guest'])->group(function () {
    Route::view('/', 'auth.login')->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login');
    // routes for password
    Route::get('/notice-reset-password', [ResetPasswordController::class, 'noticeToChangePassword'])->name('notice.change.password');
    Route::get('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendPasswordLink']);
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPasswordView'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
});


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
