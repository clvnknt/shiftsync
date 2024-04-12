<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ShiftJobs\CheckDuplicateEmployeeShiftRecordJob;
use App\Jobs\ShiftJobs\CreateEmployeeShiftRecordJob;
use App\Jobs\ShiftJobs\AssignShiftOrderJob;
use App\Models\EmployeeRecord;
use Carbon\Carbon;

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
        // Dispatch CreateEmployeeShiftRecordJob
        dispatch(new CreateEmployeeShiftRecordJob());

        // Get the current date
        $currentDate = Carbon::now()->toDateString();

        // Dispatch AssignShiftOrderJob with the current date as argument
        dispatch(new AssignShiftOrderJob($currentDate));

        // Retrieve all employee records and loop through them
        EmployeeRecord::all()->each(function ($employeeRecord) {
            // Dispatch CheckDuplicateEmployeeShiftRecordJob with the EmployeeRecord instance
            dispatch(new CheckDuplicateEmployeeShiftRecordJob($employeeRecord));
        });

        // Output success message
        $this->info('Dispatched jobs to create or update daily shift records.');
    }
}
