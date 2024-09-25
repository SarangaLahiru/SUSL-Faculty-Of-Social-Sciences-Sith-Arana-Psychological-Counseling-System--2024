<?php

namespace App\Http\Controllers\Counsellor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // Show the link request form for counsellor
    public function showLinkRequestForm()
    {
        return view('counsellors.auth.password.email');
    }

    // Send the reset password link to counsellor's email
    public function sendResetLinkEmail(Request $request)
    {
        // Validate email input
        $request->validate([
            'email' => 'required|email|exists:counsellors,email'
        ]);

        // Send the reset link to the counsellor email
        $status = Password::broker('counsellors')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', trans($status))
            : back()->withErrors(['email' => trans($status)]);
    }
}