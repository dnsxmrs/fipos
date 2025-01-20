<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

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

    // Store new user
    public function store(Request $request)
    {
        try {
            // validate the request
            $user = $request->validate([
                'first_name' => 'required|max:255|regex:/^[A-Za-z\s.-]+$/',
                'last_name' => 'required|string|max:255|regex:/^[A-Za-z\s.-]+$/',
                'email' => 'required|email|unique:users|max:255',
                'role' => 'required|in:admin,staff',
            ]);

            // Generate a random string for password
            $generatedPassword = Str::random(12);

            // hash the generated password
            $user['password'] = Hash::make($generatedPassword);

            // create the user and store it to $user for sending email purposes
            $user = User::create($user);

            // if user is successfully created
            if ($user) {
                // send the credentials to the respective email
                Mail::to($user->email)->send(new WelcomeMail($user->first_name, $user->email, $generatedPassword));
                return redirect()->back()->with('status_add', 'User added successfully.');
            } else {
                return redirect()->back()->with('error', 'Creation of account failed.');
            }
        } catch (Throwable $th) {
            dd($th);
        }
    }


    /**
     *  Update user info
     */
    public function update(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'role' => 'required|in:admin,staff',
                'status' => 'required|in:active,deactivated',
            ]);

            $user = User::find($request->user_id);

            $isUpdated = $user->update([
                'role' => $request->role,
                'status' => $request->status,
            ]);


            if ($isUpdated) {
                return redirect()->back()->with('status_edit', 'User details updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update user details.');
            }
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->with('error',  $e->getMessage());
        }
    }


    /**
     *  Delete an account
     */
    public function delete(Request $request)
    {
        $request->validate([
            'delete_user_id' => 'required|exists:users,id',
            'password' => 'required'
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            $userToDelete = User::find($request->delete_user_id);

            if ($userToDelete) {

                $userToDelete->update([
                    'status' => 'deactivated',
                ]);
                $userToDelete->delete();

                return redirect()->back()->with('status_deleted', 'User deleted successfully');
            }

            return redirect()->back()->with('error', 'Failed to delete user');
        }

        return redirect()->back()->with('error', "Password dont match.");

    }
}
