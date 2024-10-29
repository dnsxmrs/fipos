<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;

Route::view('/', 'auth.login')->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login');

Route::view('/add-user', 'user management.add-user')->name('add.user');
Route::post('/add-user', [AuthController::class, 'add'])->name('add.user');

// routes for password
Route::get('/notice-reset-password', [ResetPasswordController::class, 'noticeToChangePassword'])->name('notice.change.password');
Route::get('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.request');
Route::post('/forgot-password', [ResetPasswordController::class, 'sendPasswordLink']);
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPasswordView'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');


Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
