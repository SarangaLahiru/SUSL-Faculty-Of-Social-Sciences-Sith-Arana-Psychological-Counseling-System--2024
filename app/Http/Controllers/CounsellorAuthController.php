<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CounsellorAuthController extends Controller
{
    public function loginForm()
    {
        return view('counsellors.auth.login');
    }

    public function dashboard()
{
    return view('counsellors.dashboard.pages.dashboard');
}
    public function login(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'username' => 'required|string',
        'password' => 'required|string|min:6',
    ]);

    // If validation fails, redirect back with errors
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $credentials = $request->only('username', 'password');

    // Attempt to log the user in using the counsellor guard
    if (Auth::guard('counsellor')->attempt($credentials)) {
        return redirect()->route('counsellor.dashboard'); // Redirect to the dashboard

    }

    // If authentication fails, return back with an error message
    return back()->withErrors(['login' => 'Invalid credentials'])->withInput();
}

    public function logout()
    {
        Auth::guard('counsellor')->logout();
        return redirect()->route('counsellor.loginForm');
    }
}