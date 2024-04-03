<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;
use DateTimeZone;

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

            // Create or update the shift record
            if (!$shiftRecord) {
                // If no shift record exists for today, create a new one with null values
                $employeeRecord->employeeShiftRecords()->create([
                    'shift_date' => $currentDate,
                    'start_shift' => null,
                    'start_lunch' => null,
                    'end_lunch' => null,
                    'end_shift' => null,
                ]);
            } else {
                // If a shift record already exists for today, do nothing
                $this->info("Shift record already exists for employee ID: {$employeeRecord->id} on {$currentDate}. No changes made.");
            }
        }

        $this->info('Daily shift records created or updated successfully.');
    }
}
