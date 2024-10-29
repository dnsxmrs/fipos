<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // add the user
    public function add(Request $request) {
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

        // redirect the user back
        return redirect()->back()->with('success', 'User added successfully');
    }

    // login the user
    public function login(Request $request) {

        // validate the request
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:255']
        ]);

        try {
            // attempt to login the user
            Auth::attempt($credentials);

            // retrieve the authenticated user
            $user = Auth::user();

            // check the authenticated status
            if ($user->status !== 1) {
                // logout the user
                Auth::logout();
                $user->session()->invalidate();
                $user->session()->regenerateToken();

                throw new \Exception;
            }

            // check if user login for the first time
            if ($this->checkPassword($user->password)) {
                // force to change the password
                return redirect()->route('notice.change.password');
            }

            // redirect to dashboard
            return redirect()->intended('darboard');

        } catch (\Throwable $th) {
           // return redirect()->back()->withErrors(['failed' => $th->getMessage()]);
            return redirect()->back()->withErrors(['failed' => 'Invalid Credentials']);
        }
    }

    // method to check password
    public function checkPassword($password) {
        $default_password = 'password';

        // Check if the password matches the default password
        if (Hash::check($default_password, $password)) {
            return true; // Password matches the default
        }
        return false; // Password does not match the default
    }
}
