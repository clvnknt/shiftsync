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

class EndShiftJob implements ShouldQueue
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

        // Set the end_shift field
        if ($shiftRecord && !$shiftRecord->end_shift) {
            // Convert current time to employee's timezone
            $endShiftTime = Carbon::now()->setTimezone($employeeTimezone)->toTimeString();
            $shiftRecord->update(['end_shift' => $endShiftTime]);
        }
    }
}


