<?php

namespace App\Http\Controllers\Counsellor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    // Show the reset password form for counsellor
    public function showResetForm(Request $request, $token = null)
    {
        return view('counsellors.auth.password.reset')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // Handle the password reset process
    public function reset(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email|exists:counsellors,email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        // Attempt to reset the password
        $status = Password::broker('counsellors')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($counsellor, $password) {
                $counsellor->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('counsellor.login')->with('status', trans($status))
            : back()->withErrors(['email' => trans($status)]);
    }
}
