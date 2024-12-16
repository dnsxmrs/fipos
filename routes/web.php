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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\InventoryController;

// only authenticated users can access these pages
Route::middleware(['auth'])->group(function () {
    Route::view('/logout-confirm', 'auth.logout-modal')->name('logout.confirm');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/notice-reset-password', [ResetPasswordController::class, 'noticeToChangePassword'])->name('notice.change.password');
    Route::get('/change-password', [ChangePasswordController::class, 'showForm'])->name('change.password');
    Route::post('/change-password', [ChangePasswordController::class, 'updatePassword']);
    Route::view('/success-change-password', 'password.change-auth.success-change')->name('success.change.password');

    // ROUTES FOR CASHIER
    Route::prefix('cashier')->group(function () {
        // Redirect to the admin categories page when url is localhost:8000/admin
        Route::get('/cashier', function () {
            return redirect()->route('menu.show');
        })->name('cashier.main');

        Route::get('/menu', [MenuController::class, 'showMenu'])->name('menu.show');
        Route::get('/menu/{id}', [MenuController::class, 'showCategorizedMenu'])->name('menu.categorized');
        Route::post('/menu', [OrderController::class, 'storeOrder'])->name('order.store');
        Route::post('/pay-cash', [PaymentController::class, 'payCash'])->name('pay.cash');
        Route::post('/pay-cashless', [PaymentController::class, 'payCashless'])->name('pay.cashless');
        Route::get('/pay-cashless/success', [PaymentController::class, 'success'])->name('pay.success');
        Route::get('/orders', [OrderController::class, 'showOrders'])->name('orders.show');
        Route::get('/orders-online', [OrderController::class, 'showOnlineOrders'])->name('online.orders.show');

    });
});

// only authenticated users and admin can access this page
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Redirect to the admin categories page when url is localhost:8000/admin
        Route::get('/admin', function () {
            return redirect()->route('admin.menu.categories');
        })->name('landing');

        // routes for sidebar
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
        Route::get('/order-tracking', [AdminController::class, 'orders'])->name('order-tracking');
        Route::get('/staff-management', [AdminController::class, 'staff'])->name('staff-management');
        Route::get('/audit-trails', [AdminController::class, 'audit'])->name('audit-trails');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

        // Redirect to the admin categories page when url is localhost:8000/admin/menu
        Route::get('/menu', function () {
            return redirect()->route('admin.menu.categories');
        })->name('menu-categories');

        // Menu Management Routes
        Route::prefix('menu')->name('menu.')->group(function () {
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
        Route::prefix('inventory')->group(function() {

            Route::get('/', [InventoryController::class, 'showItems'])->name('inventory.show');
            Route::get('/{name}', [InventoryController::class, 'showCategorizedItems'])->name('inventory.categorized');

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


// Route::prefix('staffs')->name('staffs.')->group(function () {

//     Route::post('/', [StaffController::class, 'store'])->name('staff.create');
//     Route::get('/', [StaffController::class, 'index'])->name('staffs.get');
//     Route::get('/{id}', [StaffController::class, 'showStaff'])->name('staff.show');
// });

Route::get('/order-track', function () {
    return view('pos-cashier.order-track');
})->name("order.track");

Route::get('/reset', function () {
    return view('auth.reset-password');
})->name("reset");

Route::get('/online-order', function () {
    return view('pos-cashier.online-order');
})->name("online.order");



Route::get('/categories', [MenuController::class, 'categories'])->name('categories');


// Route::post('/pay-cashless', [PaymentController::class, 'payCashless'])->name('pay.cashless');
// Route::post('/pay-cashless/success', [PaymentController::class, 'success'])->name('pay.success');
Route::get('/menu', [MenuController::class, 'showMenu'])->name('menu.show');
