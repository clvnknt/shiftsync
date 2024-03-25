<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email_or_username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $credentials['email_or_username'], 'password' => $credentials['password']]) ||
            Auth::attempt(['name' => $credentials['email_or_username'], 'password' => $credentials['password']])) {
            return redirect()->route('dashboard')->with('success', 'Logged in successfully!');
        }

        return redirect()->back()->withErrors(['email_or_username' => 'These credentials do not match our records.'])->withInput($request->only('email_or_username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
