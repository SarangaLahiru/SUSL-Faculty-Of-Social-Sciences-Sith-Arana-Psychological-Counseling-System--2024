<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str; // Import Str facade
use Illuminate\Support\Facades\URL;

class AdminResetPasswordController extends Controller
{
    // Show the form to request a password reset link
    public function showLinkRequestForm()
    {
        return view('admin.auth.password.email'); // Make sure to create this view
    }

    // Send reset link email
    public function sendResetLinkEmail(Request $request)
    {
        // Validate email input
        $request->validate([
            'email' => 'required|email|exists:admins,email'
        ]);

        // Retrieve the admin user
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => trans('passwords.user')]);
        }

        // Create a reset token manually
        $token = Str::random(60);

        // Store the token in the password_resets table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $admin->email],
            [
                'email' => $admin->email,
                'token' => Hash::make($token), // Store the hashed token
                'created_at' => now(),
            ]
        );

        // Manually create the reset password URL
        $url = route('admin.password.reset', ['token' => $token, 'email' => $admin->email]);

        // Send the reset password link via email
        Mail::to($admin->email)->send(new \App\Mail\ResetPasswordMail($url));

        return back()->with('status', trans('passwords.sent'));
    }

    // Show the form for resetting the password
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.password.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    // Reset the password
    public function reset(Request $request)
    {
        // Validate the request input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        // Find the token and email in the password_resets table

        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();

        // Check if the token matches and it's valid
        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return back()->withErrors(['token' => trans('passwords.token')]);
        }

        // Reset the admin's password
        $admin = Admin::where('email', $request->email)->first();
        if ($admin) {
            $admin->password = Hash::make($request->password);
            $admin->save();

            // Delete the reset token after successful reset
            DB::table('password_resets')->where('email', $request->email)->delete();
            Auth::guard('admin')->logout();

            return redirect()->route('admin.login')->with('status', trans('passwords.reset'));
        }

        return back()->withErrors(['email' => trans('passwords.user')]);
    }
}