<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\AuthJobs\AttemptUserLoginJob;
use App\Jobs\AuthJobs\UserLogoutJob;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        AttemptUserLoginJob::dispatch($credentials)->handle();
    
        if (Auth::check()) {
            return redirect('/dashboard')->with('success', 'Logged in successfully!');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    

    public function logout(Request $request)
    {
        UserLogoutJob::dispatch()->handle();

        return redirect('login')->with('success', 'Logged out successfully!');
    }
}
