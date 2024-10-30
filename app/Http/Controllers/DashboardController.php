<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // return dashboard view
    public function index()
    {
        return view('admin.dashboard');
    }
}
