<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;

class CreateEmployeeShiftRecordsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Get all active employees
        $employees = EmployeeRecord::all();

        foreach ($employees as $employee) {
            // Calculate the shift start time in the employee's timezone
            $shiftStart = Carbon::now($employee->user->timezone)->addHour();

            // Check if the shift starts within the next hour
            if (Carbon::now()->diffInMinutes($shiftStart, false) <= 60) {
                // Check if a shift record already exists for today
                $existingShiftRecord = EmployeeShiftRecord::where('employee_record_id', $employee->id)
                    ->whereDate('shift_date', Carbon::today())
                    ->first();

                if (!$existingShiftRecord) {
                    // Create a new shift record for the employee with null values for clock-in
                    $shiftRecord = new EmployeeShiftRecord();
                    $shiftRecord->employee_record_id = $employee->id;
                    $shiftRecord->shift_date = Carbon::now()->toDateString();
                    $shiftRecord->start_shift = null;
                    $shiftRecord->start_lunch = null;
                    $shiftRecord->end_lunch = null;
                    $shiftRecord->end_shift = null;
                    $shiftRecord->save();
                }
            }
        }
    }
}