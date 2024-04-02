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

class StartLunchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = Auth::user();
        $employeeRecord = $user->employeeRecord;

        // Create or update the shift record for the current date
        $shiftRecord = $employeeRecord->employeeShiftRecords()->firstOrCreate([
            'shift_date' => Carbon::today()->toDateString(),
        ]);

        // Set the start_lunch field
        if (!$shiftRecord->start_lunch) {
            $shiftRecord->update(['start_lunch' => Carbon::now()->toTimeString()]);
        }
    }
}
