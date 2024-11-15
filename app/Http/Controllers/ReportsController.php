<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    // return reports page
    public function index()
    {
        return view('admin.reports.reports-main-page');
    }
}
