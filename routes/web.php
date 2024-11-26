<?php

use Illuminate\Support\Facades\Route;

Route::get('/cashier', function () {
    return view('cashier-draft');
});

Route::get('/product-header', function () {
    return view('product-management.product-header');
})->name("product.header");

Route::get('/product-view', function () {
    return view('product-management.product-view');
})->name("product.view");

Route::get('/product-create', function () {
    return view('product-management.product-create');
})->name("product.create");

Route::get('/product-update', function () {
    return view('product-management.product-update');
})->name("product.update");

Route::get('/product-delete', function () {
    return view('product-management.product-delete');
})->name("product.delete");

Route::get('/category-view', function () {
    return view('category-management.category-view');
})->name("category.view");

Route::get('/category-add', function () {
    return view('category-management.category-add');
})->name("category.add");

Route::get('/category-edit', function () {
    return view('category-management.modal-edit');
})->name("category.edit");

Route::get('/category-delete', function () {
    return view('category-management.modal-delete');
})->name("category.delete");

Route::get('/order-track', function () {
    return view('pos-cashier.order-track');
})->name("order.track");

Route::get('/online-order', function () {
    return view('pos-cashier.online-order');
})->name("online.order");



