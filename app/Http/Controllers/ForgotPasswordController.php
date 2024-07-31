<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }

    // Send password reset link
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email address
        $request->validate(['email' => 'required|email']);

        // Send password reset link
        $status = Password::sendResetLink($request->only('email'));

        // Check the status of the password reset operation
        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}
