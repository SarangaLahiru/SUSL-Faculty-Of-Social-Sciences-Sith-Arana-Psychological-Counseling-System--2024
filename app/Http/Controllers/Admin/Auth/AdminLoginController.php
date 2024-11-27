<?php

namespace App\Http\Controllers\Admin\Auth;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login'); // Create this view
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.counsellors');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
    public function logout()
{
    Auth::guard('admin')->logout();
    return redirect()->route('admin.login');
}
}