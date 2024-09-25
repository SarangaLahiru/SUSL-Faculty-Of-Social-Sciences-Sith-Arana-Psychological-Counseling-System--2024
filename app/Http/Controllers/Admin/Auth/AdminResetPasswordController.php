<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class AdminResetPasswordController extends Controller
{
    // Show the form to request a password reset link
    public function showLinkRequestForm()
    {
        return view('admin.auth.password.email'); // Create this view
    }

    // Send reset link email
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|exists:admins,email']);

        $response = Password::broker('admins')->sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }

    // Show the form for resetting the password
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.password.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    // Reset the password
    public function reset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        $response = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($admin, $password) {
                $admin->password = Hash::make($password);
                $admin->save();
            }
        );

        return $response == Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }
}