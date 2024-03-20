<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Jobs\ShiftJobs\{
    StartShiftJob,
    StartLunchJob,
    EndLunchJob,
    EndShiftJob,
    UpdateShiftRecordJob,
};

class ShiftController extends Controller
{
    /**
     * Start the shift for the authenticated user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function startShift()
    {
        try {
            // Get the authenticated user's ID
            $userId = Auth::id();
            
            // Update the shift record for the user
            $this->updateShiftRecord($userId);

            // Dispatch the job to start the shift
            StartShiftJob::dispatch($userId);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Shift started successfully!');
        } catch (\Exception $e) {
            // Log and handle unexpected errors
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    /**
     * Start lunch break for the authenticated user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function startLunch()
    {
        try {
            // Get the authenticated user's ID
            $userId = Auth::id();
            
            // Update the shift record for the user
            $this->updateShiftRecord($userId);

            // Dispatch the job to start lunch break
            StartLunchJob::dispatch($userId);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Lunch break started successfully!');
        } catch (\Exception $e) {
            // Log and handle unexpected errors
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    /**
     * End lunch break for the authenticated user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function endLunch()
    {
        try {
            // Get the authenticated user's ID
            $userId = Auth::id();
            
            // Update the shift record for the user
            $this->updateShiftRecord($userId);

            // Dispatch the job to end lunch break
            EndLunchJob::dispatch($userId);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Lunch break ended successfully!');
        } catch (\Exception $e) {
            // Log and handle unexpected errors
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    /**
     * End the shift for the authenticated user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function endShift()
    {
        try {
            // Get the authenticated user's ID
            $userId = Auth::id();
            
            // Update the shift record for the user
            $this->updateShiftRecord($userId);

            // Dispatch the job to end the shift
            EndShiftJob::dispatch($userId);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Shift ended successfully!');
        } catch (\Exception $e) {
            // Log and handle unexpected errors
            return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    /**
     * Update the shift record for the user.
     *
     * @param  int  $userId
     * @return void
     */
    private function updateShiftRecord($userId)
    {
        // Dispatch the job to update the shift record
        UpdateShiftRecordJob::dispatch($userId);
    }
}