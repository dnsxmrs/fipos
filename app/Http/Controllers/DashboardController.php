<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // return dashboard view
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
