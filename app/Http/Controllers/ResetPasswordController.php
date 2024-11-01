<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    // return notice to change password view
    public function noticeToChangePassword() {
        return view('password.reset-guest.notice-to-change-password');
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
        return view('password.reset-guest.reset-password', ['token' => $token]);
    }


    // Method to update password
    public function passwordUpdate(Request $request) {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required',
                            'min:8',
                            'confirmed',
                            PasswordRule::min(8)->numbers()->letters()->mixedCase()->symbols(),
                            'regex:/^\S*$/', // Disallow spaces
                        ],
                    ], [
                        'password.regex' => 'The password cannot contain spaces.',
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
                    : back()->withErrors(['error' => [__($status)]]);
    }

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
                            PasswordRule::min(8)->numbers()->letters()->mixedCase()->symbols(),
                            'regex:/^\S*$/', // Disallow spaces
                        ],
                    ], [
                        'password.regex' => 'The password cannot contain spaces.',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.success.change.password');
    }
}
