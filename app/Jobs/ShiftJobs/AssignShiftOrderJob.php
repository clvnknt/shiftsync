<?php

namespace App\Jobs\ShiftJobs;

use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AssignShiftOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Retrieve all employee shift records
            $shiftRecords = EmployeeShiftRecord::all();

            // Group shift records by assigned timezone
            $shiftRecordsByTimezone = $shiftRecords->groupBy('assigned_timezone');

            // Iterate over each group (each timezone)
            foreach ($shiftRecordsByTimezone as $timezone => $timezoneShiftRecords) {
                // Calculate the current date using the employee's timezone
                $currentDate = Carbon::now($timezone)->toDateString();

                // Filter shift records for the current date
                $currentDateShiftRecords = $timezoneShiftRecords->where('shift_date', $currentDate);

                // Sort shift records by assigned shift ID within each timezone group
                $currentDateShiftRecords = $currentDateShiftRecords->sortBy('employee_assigned_shift_id');

                // Assign shift orders within the timezone group for the current date
                $shiftOrder = 1;
                foreach ($currentDateShiftRecords as $record) {
                    $record->update(['shift_order' => $shiftOrder]);
                    $shiftOrder++;
                }
            }

            // Output success message
            Log::info('Shift orders assigned for current date based on employee timezones.');
        } catch (\Exception $e) {
            // Log any exceptions for debugging
            Log::error('Exception occurred: ' . $e->getMessage());
            Log::error('An error occurred while assigning shift orders based on employee timezones.');
        }
    }
}