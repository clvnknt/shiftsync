<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     */
    public function login(Request $request)
    {
        try {
            // Validate user credentials
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Attempt user login
            if (Auth::attempt($credentials)) {
                return redirect('/dashboard')->with('success', 'Logged in successfully!');
            }

            // Redirect back with error if login fails
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        } catch (\Exception $e) {
            // Log and handle unexpected errors
            return back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
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
            // Logout user
            Auth::logout();

            // Redirect to login page with success message
            return redirect('login')->with('success', 'Logged out successfully!');
        } catch (\Exception $e) {
            // Log and handle unexpected errors
            return back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
}
