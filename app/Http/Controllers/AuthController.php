<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // add the user
    public function add(Request $request)
    {
        // validate the request
        $user = $request->validate([
            'first_name' => ['required', 'max:255', 'regex:/^[A-Za-z\s.-]+$/'],
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z\s.-]+$/'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
        ]);

        // hash the default password
        $user['password'] = bcrypt('password');

        // create the user
        User::create($user);

        // prompt success message
        return redirect()->route('admin.success.add.user');
    }

    // login the user
    public function login(Request $request)
    {

        // Validate the request
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:255']
        ]);

        try {
            // Retrieve the user by email
            $user = User::where('email', $credentials['email'])->first();

            // Check if user exists and retrieve their status
            if ($user && $user->status === 1) {
                // Attempt to log in the user
                if (Auth::attempt($credentials)) {
                    // Retrieve the authenticated user
                    $user = Auth::user();

                    // Check if user is logging in for the first time
                    if ($this->checkPassword($user->password)) {
                        // Logout the user
                        Auth::logout();
                        $request->session()->invalidate();
                        $request->session()->regenerateToken();

                        // Redirect to change password notice
                        return redirect()->route('notice.change.password');
                    }

                    // Check user role and redirect accordingly
                    return $user->role === 'admin'
                        ? redirect()->route('admin.dashboard') // if admin
                        : redirect()->route('cashier.page');
                }
            }

            // Redirect back with an error message for invalid credentials
            return redirect()->back()->withErrors(['failed' => 'Invalid Credentials']);

        } catch (\Throwable $th) {
            // Log the error for debugging and show a generic error message
            \Log::error('Login error: ' . $th->getMessage());
            return redirect()->back()->withErrors(['failed' => 'An error occurred. Please try again.']);
        }
    }

    // method to logout the user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect to login page
        return redirect()->route('login');
    }

    // method to check password
    public function checkPassword($password)
    {
        $default_password = 'password';

        // Check if the password matches the default password
        if (Hash::check($default_password, $password)) {
            return true; // Password matches the default
        }
        return false; // Password does not match the default
    }

}
