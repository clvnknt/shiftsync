<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;

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
        // Retrieve all employee records with their associated shift records
        $employeeRecords = EmployeeRecord::with('employeeShiftRecords')->get();

        foreach ($employeeRecords as $employeeRecord) {
            // Retrieve the current shift details for the employee
            $shift = $employeeRecord->shift;
            $userTimezone = $employeeRecord->user->timezone;
            $currentDate = now()->timezone($userTimezone)->format('Y-m-d');

            // Check if there's an existing shift record for the current day
            $existingShiftRecord = $employeeRecord->employeeShiftRecords()->where('shift_date', $currentDate)->first();

            // Check if the current shift is over and it's already the next day or there's a need to update for the next shift
            if (!$existingShiftRecord || ($existingShiftRecord->end_shift && $existingShiftRecord->end_shift < now()->timezone($userTimezone)->format('H:i:s'))) {
                $nextShiftDate = now()->timezone($userTimezone)->addDay()->format('Y-m-d');

                EmployeeShiftRecord::updateOrCreate(
                    ['employee_record_id' => $employeeRecord->id, 'shift_date' => $nextShiftDate],
                    [
                        'start_shift' => null,
                        'start_lunch' => null,
                        'end_lunch' => null,
                        'end_shift' => null,
                    ]
                );
            }
        }
        
        $this->info('Daily shift records created or updated successfully.');
    }
}