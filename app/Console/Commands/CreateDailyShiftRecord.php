<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EmployeeAssignedShift;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CreateDailyShiftRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-daily-shift-record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates or updates a shift record for each employee daily.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            // Get the current date
            $currentDate = Carbon::now()->toDateString();

            // Retrieve all active assigned shifts and loop through them
            EmployeeAssignedShift::where('is_active', true)->get()->each(function ($assignedShift) use ($currentDate) {
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
                        'employee_record_id' => $assignedShift->employee_record_id,
                        'start_shift' => null,
                        'start_lunch' => null,
                        'end_lunch' => null,
                        'end_shift' => null,
                    ]);

                    // Log shift record creation for debugging
                    Log::info('Shift record created for Employee ID: ' . $assignedShift->employee_record_id);
                }
            });

            // Retrieve all employee records and loop through them
            EmployeeRecord::all()->each(function ($employeeRecord) {
                // Retrieve the timezone of the employee
                $employeeTimezone = $employeeRecord->timezone;

                // Calculate today's date based on the employee's timezone
                $currentDate = Carbon::now($employeeTimezone)->toDateString();

                // Retrieve the current shift records for the employee and today's date
                $shiftRecords = $employeeRecord->employeeShiftRecords()
                    ->where('shift_date', $currentDate)
                    ->get();

                // If multiple shift records exist for today, find and delete duplicate records
                if ($shiftRecords->count() > 1) {
                    $uniqueAssignedShiftIds = $shiftRecords->pluck('employee_assigned_shift_id')->unique()->values();

                    foreach ($uniqueAssignedShiftIds as $assignedShiftId) {
                        $recordsWithAssignedShiftId = $shiftRecords->where('employee_assigned_shift_id', $assignedShiftId);

                        if ($recordsWithAssignedShiftId->count() > 1) {
                            // Keep the first record and delete the rest
                            $recordsWithAssignedShiftId->slice(1)->each(function ($record) {
                                $record->delete();
                            });
                        }
                    }
                }
            });

            // Output success message
            $this->info('Daily shift records creation or update completed successfully.');
        } catch (\Exception $e) {
            // Log any exceptions for debugging
            Log::error('Exception occurred: ' . $e->getMessage());
            $this->error('An error occurred while creating or updating daily shift records.');
        }
    }
}
