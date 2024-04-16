<?php

namespace App\Jobs\ShiftJobs;

use App\Models\EmployeeShiftRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AssignTimezoneJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Get shift records where assigned_timezone is null
            $shiftRecords = EmployeeShiftRecord::whereNull('assigned_timezone')->get();

            // Log the count of shift records retrieved
            Log::info('Number of shift records to process: ' . $shiftRecords->count());

            // Loop through each shift record
            foreach ($shiftRecords as $record) {
                // Get the employee's timezone from the associated EmployeeRecord
                $timezone = $record->employeeRecord->employee_timezone;

                // Log the retrieved timezone
                Log::info("Retrieved timezone '$timezone' for shift record ID: {$record->id}");

                // Update the assigned_timezone field in the shift record
                $record->update(['assigned_timezone' => $timezone]);

                // Log the update
                Log::info("Assigned timezone '$timezone' to shift record ID: {$record->id}");
            }

            // Output success message
            Log::info('Assigned timezones to shift records successfully.');
        } catch (\Exception $e) {
            // Log any exceptions for debugging
            Log::error('Exception occurred: ' . $e->getMessage());
            Log::error('An error occurred while assigning timezones to shift records.');
        }
    }
}
