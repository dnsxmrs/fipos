<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChangePasswordController extends Controller
{

    // Method to return change password view
    public function changePasswordView() {
        return view('password.change-auth.change-password');
    }

    // Method to change password
    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => ['required', 'max:255'],
            'password' => ['required',
                            'min:8',
                            'confirmed',
                            'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_])\S{8,}$/'
                        ],
                    ], [
                        'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number and one special character.',
        ]);

        $user = Auth::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.success.change.password');
    }
}
