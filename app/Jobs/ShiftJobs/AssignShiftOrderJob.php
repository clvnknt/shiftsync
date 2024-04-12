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

    protected $date;

    /**
     * Create a new job instance.
     */
    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Retrieve all shift records for the given date, grouped by employee and ordered by start shift time
            $shiftRecordsByEmployee = EmployeeShiftRecord::where('shift_date', $this->date)
                ->orderBy('start_shift')
                ->get()
                ->groupBy('employee_record_id');

            // Assign unique shift orders for each employee, starting from 1 for the earliest shift of the day
            foreach ($shiftRecordsByEmployee as $employeeId => $shiftRecords) {
                $shiftOrder = 1;
                foreach ($shiftRecords as $record) {
                    $record->update(['shift_order' => $shiftOrder]);
                    $shiftOrder++;
                }
            }

            // Output success message
            Log::info('Shift order assigned for date: ' . $this->date);
        } catch (\Exception $e) {
            // Log any exceptions for debugging
            Log::error('Exception occurred: ' . $e->getMessage());
            Log::error('An error occurred while assigning shift order for date: ' . $this->date);
        }
    }
}
