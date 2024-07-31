<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\EmployeeShiftRecord;
use App\Jobs\TimesheetJobs\CalculateHoursRenderedJob;
use App\Jobs\TimesheetJobs\CalculateTardiness;
use App\Jobs\TimesheetJobs\CalculateOvertime;

class CheckShiftEndTimes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shift:check-end-times';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check end shift column in employee shift records and dispatch necessary jobs';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Log a debug message indicating the start of the command
        Log::debug('Starting CheckShiftEndTimes command execution.');

        // Retrieve employee shift records where end_shift column is not null and hours_rendered is null
        $shifts = EmployeeShiftRecord::whereNotNull('end_shift')
            ->whereNull('hours_rendered')
            ->get();

        // Log the number of shift records retrieved
        Log::debug('Retrieved ' . $shifts->count() . ' shift records with end_shift not null and hours_rendered null.');

        // Loop through each shift record
        foreach ($shifts as $shift) {
            // Dispatch necessary jobs for the shift record
            dispatch(new CalculateHoursRenderedJob($shift->id));
            dispatch(new CalculateTardiness($shift->id));
            dispatch(new CalculateOvertime($shift->id));

            // Log a debug message indicating the dispatch of jobs for the shift record
            Log::debug('Jobs dispatched for shift record ID: ' . $shift->id);
        }

        // Output success message
        $this->info('Shift end times checked and necessary jobs dispatched.');

        // Log a debug message indicating the end of the command
        Log::debug('CheckShiftEndTimes command execution completed.');
    }
}