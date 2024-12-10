<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    /**
     * Register a new user
     */
    public function registerUser(Request $request)
    {

        // validate the request
        $user = $request->validate([
            'first_name' => 'required|max:255|regex:/^[A-Za-z\s.-]+$/',
            'last_name' => 'required|string|max:255|regex:/^[A-Za-z\s.-]+$/',
            'email' => 'required|email|unique:users|max:255'
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

            // prompt success message
            return redirect()->route('admin.success.add.user');
        } else {
            return redirect()->back()->with(['error' => 'Creation of account failed.']);
        }
    }


    /**
     * Display the login page
     */
    public function displayLoginForm()
    {
        return view('auth.login');
    }



    /**
     * Login the user
     */
    public function login(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:255'
        ]);

        // attempt to authenticate the user
        if (Auth::attempt($credentials)) {

            // get the authenticated user
            $user = Auth::user();

            // check if the account is not yet activated
            if ($user->is_activated === 0) {

                // change is_activated to 1
                $user->is_activated = 1;
                // Save the changes to the database
                $user->save();

                // force to change password
                return redirect()->route('notice.change.password');
            }

            // Log the login activity for audit trailing purposes
            activity('user_login')->log('user login');

            // Check user role and redirect accordingly
            return $user->role === 'admin'
                ? redirect()->route('admin.dashboard') // if admin
                : redirect()->route('menu.show');
        }

        // log the user attempt to login
        activity('attempt_login')->log('attempt to login');

        // Redirect back with an error message for invalid credentials
        return redirect()->back()->withErrors(['failed' => 'Invalid Credentials']);
    }

    /**
     * Logout the user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect to login page
        return redirect()->route('login');
    }

}
