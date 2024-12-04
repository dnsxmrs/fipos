<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }

    public function reports()
    {
        return view('admin.reports.reports');
    }

    public function orders()
    {
        return view('admin.order-tracking');
    }

    public function staff()
    {
        $users = User::all();

        return view('admin.staffs.index', compact('users'));
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
