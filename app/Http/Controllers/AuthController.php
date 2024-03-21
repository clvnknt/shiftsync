<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle user login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'username_or_email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('password');
        $field = filter_var($request->username_or_email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $credentials[$field] = $request->username_or_email;

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard')->with('success', 'Logged in successfully!');
        }

        throw ValidationException::withMessages([
            'username_or_email' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Handle user logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        try {
            Auth::logout();
            return redirect('login')->with('success', 'Logged out successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
}