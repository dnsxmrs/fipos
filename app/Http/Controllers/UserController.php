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
            return redirect()->back()->with('success_add', 'User added successfully.');
        } else {
            return redirect()->back()->with('error', 'Creation of account failed.');
        }
    }


    /**
     *  Update user info
     */
    public function update(Request $request)
    {
        try{
            dd($request);
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'lastname' => 'required|max:255|regex:/^[A-Za-z\s.-]+$/',
                'firstname' => 'required|string|max:255|regex:/^[A-Za-z\s.-]+$/',
                'email' => 'required|email|unique:users|max:255',
                'role' => 'required|in:admin,staff',
            ]);

            $user = User::find($request->user_id);

            $isUpdated = $user->update([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'email' => $request->email,
                'role' => $request->role,
            ]);

            if($isUpdated) {
                return redirect()->back()->with('success_edit', 'User details updated successfully.');
            }
            else {
                return redirect()->back()->with('error', 'Failed to update user details.');
            }
        }
        catch (ValidationException $th) {
            dd($th);
        }

    }


    /**
     *  Deactivate an account
     */
    public function deactivate(Request $request)
    {
        $request->validate([
            'delete_user_id' => 'required|exists:items,id',
            'password' => 'required'
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            $userToDeactivate = User::find($request->delete_user_id);

            if ($userToDeactivate) {
                $userToDeactivate->delete();
                $userToDeactivate->update([
                    'is_activated' => 0,
                ]);
                return redirect()->back()->with('status_deleted', 'User deactivated successfully');
            }

            return redirect()->back()->with('error', 'Failed to deactivate the user');
        }

        return redirect()->back()->with('error', 'Password don\'t match.');
    }
}
