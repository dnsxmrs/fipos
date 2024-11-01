<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $users = User::all();

        return view('admin.staff-management', compact('users'));
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
