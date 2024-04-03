<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;

class StartShiftJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

        // Set the start_shift field
        if ($shiftRecord && !$shiftRecord->start_shift) {
            // Convert current time to employee's timezone
            $startTime = Carbon::now()->setTimezone($employeeTimezone)->toTimeString();
            $shiftRecord->update(['start_shift' => $startTime]);
        }
    }
}
