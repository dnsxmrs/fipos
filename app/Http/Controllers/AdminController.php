<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function menu()
    {
        return view('admin.menu');
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function orders()
    {
        return view('admin.order-tracking');
    }

    public function staff()
    {
        return view('admin.staff-management');
    }

    public function audit()
    {
        return view('admin.audit-trails');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
