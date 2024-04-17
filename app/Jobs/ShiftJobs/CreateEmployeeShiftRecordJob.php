<?php

namespace App\Jobs\ShiftJobs;

use App\Models\EmployeeAssignedShift;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateEmployeeShiftRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $employeeTimezone;

    /**
     * Create a new job instance.
     *
     * @param string $employeeTimezone The timezone of the employee
     */
    public function __construct($employeeTimezone)
    {
        $this->employeeTimezone = $employeeTimezone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            // Calculate the current date using the employee's timezone
            $currentDate = Carbon::now($this->employeeTimezone)->toDateString();

            // Retrieve the employee records with the provided timezone
            $employees = EmployeeRecord::where('employee_timezone', $this->employeeTimezone)->get();

            // Loop through the employees and create shift records for their active assigned shifts
            foreach ($employees as $employee) {
                $assignedShifts = $employee->assignedShifts()->where('is_active', true)->get();

                foreach ($assignedShifts as $assignedShift) {
                    // Check if there is no existing shift record for this assigned shift and date
                    $existingShiftRecord = EmployeeShiftRecord::where('employee_assigned_shift_id', $assignedShift->id)
                        ->where('shift_date', $currentDate)
                        ->exists();

                    // If no existing shift record found, create a new one
                    if (!$existingShiftRecord) {
                        // Create a new shift record for this assigned shift and date
                        EmployeeShiftRecord::create([
                            'shift_date' => $currentDate,
                            'employee_assigned_shift_id' => $assignedShift->id,
                            'employee_record_id' => $employee->id,
                            'start_shift' => null,
                            'start_lunch' => null,
                            'end_lunch' => null,
                            'end_shift' => null,
                        ]);

                        // Log shift record creation for debugging
                        Log::info('Shift record created for Employee ID: ' . $employee->id);
                    }
                }
            }

            // Output success message
            Log::info('Daily shift records creation or update completed successfully.');
        } catch (\Exception $e) {
            // Log any exceptions for debugging
            Log::error('Exception occurred: ' . $e->getMessage());
            Log::error('An error occurred while creating or updating daily shift records.');
        }
    }
}