<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // method to display user
    public function showUsers()
    {
        // retrieve all users
        $users = User::paginate(10);

        // return the view
        return view('admin.users.index', ['users' => $users]);
    }
}
