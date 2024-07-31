<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    // Show the email verification notice
    public function showVerificationNotice(Request $request)
    {
        // Check if the user's email is not verified
        if (!$request->user()->hasVerifiedEmail()) {
            // If not verified, send the verification email notification
            $request->user()->sendEmailVerificationNotification();
        }

        // Return the view for the email verification notice
        return view('auth.email-verification.verify-email');
    }

    // Verify the email using the EmailVerificationRequest
    public function verify(EmailVerificationRequest $request)
    {
        // Fulfill the email verification request
        $request->fulfill();

        // Return the view for the email verification success message
        return view('auth.email-verification.email-verified');
    }

    // Resend the verification email notification
    public function resendVerificationNotification(Request $request)
    {
        // Send the verification email notification
        $request->user()->sendEmailVerificationNotification();

        // Redirect back with a success message
        return back()->with('message', 'Verification link sent!');
    }
}
