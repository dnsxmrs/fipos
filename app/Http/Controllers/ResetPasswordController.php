<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    // return notice to change password view
    public function noticeToChangePassword() {
        return view('password.change-auth.notice-to-change-password');
    }

    // return forgot passsword view with email input
    public function forgotPassword() {
        return view('password.reset-guest.forgot-password');
    }

    // method to send reset password link
    public function sendPasswordLink(Request $request) {
        // validate email
        $request->validate(['email' => ['required', 'email']]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }


    // Method to return reset password view
    public function resetPasswordView($token) {
        return view('auth.reset-password', ['token' => $token]);
    }


    // Method to update password
    public function passwordUpdate(Request $request) {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
