<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    // return notice to change password view
    public function noticeToChangePassword() {
        return view('password.notice-to-change-password');
    }


    // Redirect to respective pages if skipped
    public function skipChangePassword()
    {
        $userRole = Auth::user()->role;

        if ($userRole === 'staff') {

            return redirect()->route('menu.show');

        } else if ($userRole === 'admin') {

            return redirect()->route('admin.dashboard');

        }
    }

    // return forgot passsword view with email input
    public function forgotPassword() {
        return view('password.forgot-password');
    }

    // method to send reset password link
    public function sendPasswordLink(Request $request) {
        // validate email
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        // log the activity
        activity('User Forgot Password')->causedBy(Auth::user())->log('Forgot password');

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }


    // Method to return reset password view
    public function resetPasswordView($token) {
        return view('password.reset-password', ['token' => $token]);
    }


    // Method to update password
    public function passwordUpdate(Request $request) {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required',
                            'min:8',
                            'confirmed',
                            'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_])\S{8,}$/'
                        ],
                    ], [
                        'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number and one special character.',
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

        // log the activity
        activity('User Reset Password')->causedBy(Auth::user())->log('Reset password');

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['error' => [__($status)]]);
    }


}
