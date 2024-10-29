<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

// Main welcome route
Route::get('/', function () {
    return view('welcome');
});

// Route for sign-up confirmation page
Route::get('/sign-up-confirmation', function (): Factory|View {
    return view('admin-account-setup.sign-up-confirmation');
});

// Route to handle form submission and redirect to confirmation
Route::post('/account-setup', function () {
    // Here you could process the form data (e.g., save to the database).
    // After processing, redirect to the confirmation page.
    return redirect('/sign-up-confirmation');
})->name('account-setup');

// Change password complete
Route::get('/change-pass-complete', function (): Factory|View {
    return view('admin-account-setup.change-pass-complete');
});

Route::post('/change pass complete', function () {
    return redirect('/change-pass-complete');
})->name('change pass complete');

// Change Password
Route::get('/change-password', function (): Factory|View {
    return view('admin-account-setup.change-password');
});

Route::post('/change password', function () {
    return redirect('/change-password');
})->name('change password');

// Check email
Route::get('/check-email', function (): Factory|View {
    return view('admin-account-setup.check-email');
});

Route::post('/check email', function () {
    return redirect('/check-email');
})->name('check email');

// Email verified
Route::get('/email-verified', function (): Factory|View {
    return view('admin-account-setup.email-verified');
});

Route::post('/email verified', function () {
    return redirect('/email-verified');
})->name('email verified');

// Log-in Admin
Route::get('/log-in-admin', function (): Factory|View {
    return view('admin-account-setup.log-in-admin');
});

Route::post('/log in admin', function () {
    return redirect('/log-in-admin');
})->name('log in admin');

// Reset password
Route::get('/reset-password', function (): Factory|View {
    return view('admin-account-setup.reset-password');
});

Route::post('/reset password', function () {
    return redirect('/reset-password');
})->name('reset password');

// Sign up success
Route::get('/sign-up-success', function (): Factory|View {
    return view('admin-account-setup.sign-up-success');
});

Route::post('/sign up success', function () {
    return redirect('/sign-up-success');
})->name('sign up success');

// Dashboard summary
Route::get('/dashboard-summary', function (): Factory|View {
    return view('reports-dashboard.dashboard-summary');
});

Route::post('/dashboard summary', function () {
    return redirect('/dashboard-summary');
})->name('dashboard summary');

// Order management
Route::get('/order-management', function (): Factory|View {
    return view('reports-dashboard.order-management');
});

Route::post('/order management', function () {
    return redirect('/order-management');
})->name('order management');

// User management
Route::get('/edit-profile', function (): Factory|View {
    return view('user-management.edit-profile');
});

Route::post('/edit profile', function () {
    return redirect('/edit-profile');
})->name('edit profile');

// Role management
Route::get('/role-management', function (): Factory|View {
    return view('user-management.role-management');
});

Route::post('/role management', function () {
    return redirect('/role-management');
})->name('role management');

// User management
Route::get('/user-management', function (): Factory|View {
    return view('user-management.user-management');
});

Route::post('/user management', function () {
    return redirect('/user-management');
})->name('user management');
