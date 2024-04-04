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

class CheckDuplicateEmployeeShiftRecordJob implements ShouldQueue
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
            // Retrieve the timezone of the employee
            $employeeTimezone = $employeeRecord->timezone;

            // Calculate today's date based on the employee's timezone
            $currentDate = Carbon::now($employeeTimezone)->toDateString();

            // Retrieve the current shift record for the employee and today's date
            $shiftRecord = $employeeRecord->employeeShiftRecords()
                ->where('shift_date', $currentDate)
                ->first();

            // If a shift record already exists for today, find and delete any duplicate records
            if ($shiftRecord) {
                $duplicateShiftRecords = $employeeRecord->employeeShiftRecords()
                    ->where('shift_date', $currentDate)
                    ->where('id', '!=', $shiftRecord->id) // Exclude the current shift record
                    ->get();

                foreach ($duplicateShiftRecords as $duplicateShiftRecord) {
                    $duplicateShiftRecord->delete();
                }
            }
        }
    }
}
