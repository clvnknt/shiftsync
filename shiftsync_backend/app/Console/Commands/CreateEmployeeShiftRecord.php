<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Jobs\ShiftJobs\CheckDuplicateEmployeeShiftRecordJob;
use App\Jobs\ShiftJobs\CreateEmployeeShiftRecordJob;
use App\Jobs\ShiftJobs\AssignShiftOrderJob;
use App\Jobs\ShiftJobs\AssignTimezoneJob;
use App\Models\EmployeeRecord;


class CreateEmployeeShiftRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-employee-shift-record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Retrieve all employee records and loop through them
            EmployeeRecord::all()->each(function ($employeeRecord) {
                // Get the employee's timezone
                $employeeTimezone = $employeeRecord->employee_timezone;
                // Dispatch CreateEmployeeShiftRecordJob with the employee's timezone
                dispatch(new CreateEmployeeShiftRecordJob($employeeTimezone))->chain([
                    new AssignShiftOrderJob(),
                ]);
            });

            // Retrieve all employee records and loop through them
            EmployeeRecord::all()->each(function ($employeeRecord) {
                // Dispatch CheckDuplicateEmployeeShiftRecordJob with the EmployeeRecord instance
                dispatch(new CheckDuplicateEmployeeShiftRecordJob($employeeRecord));
            });

            // Output success message
            $this->info('Dispatched jobs to create or update daily shift records.');
        } catch (\Exception $e) {
            // Log the exception and stop further job dispatching
            Log::error('An error occurred: ' . $e->getMessage());
            $this->error('Failed to dispatch jobs. Check the logs for details.');
        }
    }
}
