<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProduct;

class DashboardController extends Controller
{
    // return dashboard view
    public function index()
    {

        return view('admin.dashboard');
    }
}
