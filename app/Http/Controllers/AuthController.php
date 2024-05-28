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

        // Extract the remember input from the request
        $remember = $request->has('remember');

        // Attempt to authenticate the user with the provided credentials and remember option
        if (Auth::attempt(
            ['email' => $credentials['email_or_username'], 'password' => $credentials['password']], 
            $remember
        ) || Auth::attempt(
            ['name' => $credentials['email_or_username'], 'password' => $credentials['password']],
            $remember
        )) {
            $user = Auth::user();

            if ($user->is_admin) {
                return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully as admin!');
            } else {
                return redirect()->route('dashboard')->with('success', 'Logged in successfully!');
            }
        }

        // If authentication fails, redirect back with error message
        return redirect()->back()->withErrors(['email_or_username' => 'These credentials do not match our records.'])->withInput($request->only('email_or_username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}