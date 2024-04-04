<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EmployeeRecord;
use App\Jobs\ShiftJobs\CheckDuplicateEmployeeShiftRecordJob;
use App\Jobs\ShiftJobs\CreateEmployeeShiftRecordJob;

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
            // Dispatch CheckDuplicateEmployeeShiftRecordJob
            CheckDuplicateEmployeeShiftRecordJob::dispatch($employeeRecord);

            // Dispatch CreateEmployeeShiftRecordJob
            CreateEmployeeShiftRecordJob::dispatch($employeeRecord);
        }

        $this->info('Daily shift records creation or update jobs dispatched successfully.');
    }
}
