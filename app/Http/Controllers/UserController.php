<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // method to display user
    public function display() {
        // retrieve all users
        $users = User::all();

        // return the view
        return view('user management.list-user', ['users' => $users]);
    }
}
