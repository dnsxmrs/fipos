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
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderTrackingController;
use App\Models\Order;

// only authenticated users can access these pages
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/notice-change-password', [ResetPasswordController::class, 'noticeToChangePassword'])->name('notice.change.password');
    Route::get('/notice-change-password/skip', [ResetPasswordController::class, 'skipChangePassword'])->name('password.skip');
    Route::get('/change-password', [ChangePasswordController::class, 'showForm'])->name('change.password');
    Route::post('/change-password', [ChangePasswordController::class, 'updatePassword']);

    // ROUTES FOR CASHIER
    Route::prefix('cashier')->group(function () {

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

    // Admin Routes
    Route::middleware(['isAdmin'])->group(function () {
        // Admin Routes
        Route::prefix('admin')->name('admin.')->group(function () {
            // Redirect to the admin categories page when url is localhost:8000/admin
            Route::get('/', function () {
                return redirect()->route('admin.dashboard');
            })->name('landing');

            // routes for sidebar
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/payments', [PaymentController::class, 'showPayments'])->name('payments');
            Route::get('/order-tracking', [AdminController::class, 'orders'])->name('order-tracking');
            Route::get('/audit-trails', [AdminController::class, 'audit'])->name('audit-trails');
            Route::get('/audit-trails/export', [AdminController::class, 'exportCsv'])->name('audit-trails.export');

            Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

            // Payments
            Route::prefix('payments')->group(function () {
                Route::get('/', [PaymentController::class, 'showPayments'])->name('payments');
                Route::get('/export', [PaymentController::class, 'export'])->name('payments.export');
            });


            // Menu Management Routes
            Route::prefix('menu')->name('menu.')->group(function () {
                // Redirect to the admin categories page when url is localhost:8000/admin/menu
                Route::get('/', function () {
                    return redirect()->route('admin.menu.categories');
                })->name('menu.categories');

                // Categories Routes
                Route::prefix('categories')->group(function () {

                    Route::get('/', [MenuController::class, 'showCategories'])->name('categories');
                    // Route to store a new category
                    Route::post('/add', [CategoryController::class, 'store'])->name('categories.store');
                    // Route to update a category
                    Route::put('/edit', [CategoryController::class, 'update'])->name('categories.update');
                    // Route to delete a category
                    Route::post('/delete', [CategoryController::class, 'delete'])->name('categories.delete');
                    Route::get('/export', [CategoryController::class, 'exportCategories'])->name('categories.export');
                });


                // Products Routes
                Route::prefix('products')->group(function () {

                    Route::get('/', [MenuController::class, 'showProducts'])->name('products');
                    // Route to store a new product
                    Route::post('/add', [ProductController::class, 'store'])->name('products.store');
                    // Route to update a product
                    Route::put('/edit', [ProductController::class, 'update'])->name('products.update');
                    // Route to delete a product
                    // Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('products.delete');
                    Route::post('/delete', [ProductController::class, 'delete'])->name('products.delete');
                    Route::get('/export', [ProductController::class, 'exportProducts'])->name('products.export');
                });
            });


            // Inventory routes
            // Route::prefix('inventory')->group(function () {

            //     Route::get('/', function () {
            //         return redirect()->route('admin.inventory.show');
            //     });

            //     // Categories
            //     Route::prefix('categories')->group(function () {
            //         Route::get('/', [InventoryController::class, 'showCategories'])->name('inventory.categories');
            //         Route::post('/add', [InventoryCategoryController::class, 'store'])->name('inventory.category.add');
            //         Route::post('/edit', [InventoryCategoryController::class, 'update'])->name('inventory.category.update');
            //         Route::post('/delete', [InventoryCategoryController::class, 'destroy'])->name('inventory.category.destroy');
            //     });

            //     // Items
            //     Route::prefix('items')->group(function () {
            //         Route::get('/', [InventoryController::class, 'showItems'])->name('inventory.show');
            //         Route::post('/add', [ItemController::class, 'store'])->name('inventory.item.store');
            //         Route::post('/update', [ItemController::class, 'update'])->name('inventory.item.update');
            //         Route::post('/delete', [ItemController::class, 'destroy'])->name('inventory.item.destroy');
            //     });
            // });

            // // Staff Management routes
            // Route::prefix('staffs')->group(function () {
            //     Route::get('/', [StaffController::class, 'index'])->name('staffs.show');
            // });

            // Order Tracking
            Route::prefix('order-tracking')->group(function () {
                Route::get('/', [OrderTrackingController::class, 'index'])->name('orders.all');
                Route::get('/walk-in-orders', [OrderTrackingController::class, 'showWalkInOrders'])->name('orders.walk-in');
                Route::get('/online-orders', [OrderTrackingController::class, 'showOnlineOrders'])->name('orders.online-orders');
                Route::get('/orders/export', [OrderController::class, 'exportOrders'])->name('orders.export');
                // Route::get('/orders/dine-in/export', [OrderController::class, 'exportWalkinInOrders'])->name('orders.export.walk-in');
            });

            // User Management routes
            Route::prefix('users')->group(function () {

                Route::get('/', [UserController::class, 'showUsers'])->name('users.show');
                Route::post('/add', [UserController::class, 'store'])->name('user.add');
                Route::post('/edit', [UserController::class, 'update'])->name('user.update');
                Route::post('/delete', [UserController::class, 'delete'])->name('user.delete');
                Route::post('/confirm-add', [UserController::class, 'confirmAddUser'])->name('user.confirm-add');
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
        });
    });
});


// only guests can access these pages
Route::middleware(['isGuest', 'preventBackHistory'])->group(function () {
    Route::get('/', [AuthController::class, 'displayLoginForm'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
    // routes for password
    Route::get('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendPasswordLink']);
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPasswordView'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
});

Route::get('/dashboard/most-ordered', [AdminController::class, 'getMostOrdered'])->name('dashboard.mostOrdered');
Route::get('/dashboard/most-order-types', [AdminController::class, 'getMostOrderTypes'])->name('dashboard.mostOrderTypes');

