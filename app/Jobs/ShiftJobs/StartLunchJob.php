<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StartLunchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = Auth::user();
        $employeeRecord = $user->employeeRecord;

        // Retrieve the shift record for the current date
        $shiftRecord = $employeeRecord->employeeShiftRecords()
            ->where('shift_date', Carbon::today()->toDateString())
            ->first();

        // Get the employee's timezone
        $employeeTimezone = $employeeRecord->user->timezone;

        // Set the start_lunch field
        if ($shiftRecord && !$shiftRecord->start_lunch) {
            // Convert current time to employee's timezone
            $startLunchTime = Carbon::now()->setTimezone($employeeTimezone)->toTimeString();
            $shiftRecord->update(['start_lunch' => $startLunchTime]);
        }
    }
}
