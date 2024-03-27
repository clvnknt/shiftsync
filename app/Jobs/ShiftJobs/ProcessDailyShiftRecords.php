<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;

class ProcessDailyShiftRecords implements ShouldQueue
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
        // Retrieve all employee records
        $employeeRecords = EmployeeRecord::all();

        foreach ($employeeRecords as $employeeRecord) {
            // Find or create the shift record for today
            $shiftRecord = EmployeeShiftRecord::firstOrCreate([
                'employee_record_id' => $employeeRecord->id,
                'shift_date' => Carbon::today()->toDateString(),
            ]);

            // Update the shift record if necessary
            if (!$shiftRecord->start_shift) {
                $shiftRecord->start_shift = Carbon::now();
                $shiftRecord->save();
            } elseif ($shiftRecord->start_shift && !$shiftRecord->end_shift) {
                // Check if the shift is ongoing and needs to be ended
                // Here, you can add your logic to handle shift ending conditions
                // For example, if the shift duration exceeds a certain limit, automatically end it
                // For simplicity, we'll assume that shifts end after 12 hours
                if (Carbon::now()->diffInHours($shiftRecord->start_shift) >= 12) {
                    $shiftRecord->end_shift = Carbon::now();
                    $shiftRecord->save();
                }
            }
        }
    }
}