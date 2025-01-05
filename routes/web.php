<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\InventoryController;

// only authenticated users can access these pages
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/notice-change-password', [ResetPasswordController::class, 'noticeToChangePassword'])->name('notice.change.password');
    Route::get('/notice-change-password/skip', [ResetPasswordController::class, 'skipChangePassword'])->name('password.skip');
    Route::get('/change-password', [ChangePasswordController::class, 'showForm'])->name('change.password');
    Route::post('/change-password', [ChangePasswordController::class, 'updatePassword']);

    // ROUTES FOR CASHIER
    Route::prefix('cashier')->group(function () {
        // Redirect to the admin categories page when url is localhost:8000/cashier
        Route::get('/', function () {
            return redirect()->route('menu.show');
        });

        Route::get('/menu', [MenuController::class, 'showMenu'])->name('menu.show');
        Route::post('/menu', [OrderController::class, 'storeOrder'])->name('order.store');
        Route::post('/pay-cash', [PaymentController::class, 'payCash'])->name('pay.cash');
        Route::post('/pay-cashless', [PaymentController::class, 'payCashless'])->name('pay.cashless');
        Route::get('/pay-cashless/success', [PaymentController::class, 'success'])->name('pay.success');
        Route::get('/orders', [OrderController::class, 'showOrders'])->name('orders.show');
        Route::get('/orders/dine-in', [OrderController::class, 'showDineInOrders'])->name('orders.dine-in');
        Route::get('/orders/take-out', [OrderController::class, 'showTakeOutOrders'])->name('orders.take-out');
        Route::get('/orders-online', [OrderController::class, 'showOnlineOrders'])->name('online.orders.show');
    });
});

// only authenticated users and admin can access this page
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Redirect to the admin categories page when url is localhost:8000/admin
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        })->name('landing');

        // routes for sidebar
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
        Route::get('/order-tracking', [AdminController::class, 'orders'])->name('order-tracking');
        Route::get('/audit-trails', [AdminController::class, 'audit'])->name('audit-trails');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

        // Menu Management Routes
        Route::prefix('menu')->name('menu.')->group(function () {
            // Redirect to the admin categories page when url is localhost:8000/admin/menu
            Route::get('/', function () {
                return redirect()->route('admin.menu.categories');
            })->name('menu.categories');


            // Route to display the categories and products
            Route::get('/categories', [MenuController::class, 'showCategories'])->name('categories');
            Route::get('/products', [MenuController::class, 'showProducts'])->name('products');

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


        // Inventory routes
        Route::prefix('inventory')->group(function () {

            Route::get('/', [InventoryController::class, 'showItems'])->name('inventory.show');
            Route::get('/category', [InventoryController::class, 'showCategories'])->name('inventory.categories');
            Route::post('/category/add', [InventoryCategoryController::class, 'store'])->name('inventory.category.add');
            Route::post('/category/edit', [InventoryCategoryController::class, 'update'])->name('inventory.category.update');
            Route::get('/{name}', [InventoryController::class, 'showCategorizedItems'])->name('inventory.categorized');
        });

        // Staff Management routes
        Route::prefix('staffs')->group(function() {

            Route::get('/', [StaffController::class, 'index'])->name('staffs.show');

        });


        // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::view('/add-user', 'user management.add-user')->name('add.user');
        Route::post('/add-user', [AuthController::class, 'registerUser']);

        Route::view('/edit-profile', 'user management.edit-profile')->name('update.profile');
        Route::post('/edit-profile', [ProfileController::class, 'updateProfile']);

        Route::view('/success-add-user', 'user management.success-add')->name('success.add.user');
        Route::view('/success-update-profile', 'user management.success-edit')->name('success.update.profile');

        Route::view('/list-user', 'user management.list-user')->name('list.user');
        Route::view('/role-management', 'user management.role-management')->name('role-management');
        Route::get('/users', [UserController::class, 'display'])->name('users.index');
    });
});

// only guests can access these pages
Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'displayLoginForm'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
    // routes for password
    Route::get('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendPasswordLink']);
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPasswordView'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
});
