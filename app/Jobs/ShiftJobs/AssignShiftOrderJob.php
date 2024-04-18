<?php

namespace App\Jobs\ShiftJobs;

use App\Models\EmployeeAssignedShift;
use App\Models\EmployeeShiftRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AssignShiftOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Retrieve all unique shift dates
            $shiftDates = EmployeeShiftRecord::select('shift_date')->distinct()->pluck('shift_date');

            // Iterate over each shift date
            foreach ($shiftDates as $shiftDate) {
                // Retrieve all shift records for this date
                $shiftRecords = EmployeeShiftRecord::where('shift_date', $shiftDate)->get();

                // Group shift records by employee ID
                $groupedRecords = $shiftRecords->groupBy('employee_record_id');

                // Iterate over each group
                foreach ($groupedRecords as $employeeId => $records) {
                    // Retrieve the assigned shift schedule for this employee
                    $assignedShift = EmployeeAssignedShift::where('employee_record_id', $employeeId)->first();
                    $shiftSchedule = $assignedShift->shiftSchedule;

                    // Sort shift records by the start_shift_time of the corresponding shift schedule
                    $records = $records->sortBy(function ($record) use ($shiftSchedule) {
                        return $shiftSchedule->start_shift_time;
                    });

                    // Initialize shift order counter
                    $shiftOrder = 1;

                    // Update shift orders for each record in this group
                    foreach ($records as $record) {
                        $record->update(['shift_order' => $shiftOrder]);
                        $shiftOrder++;
                    }
                }
            }

            // Output success message
            Log::info('Shift orders assigned based on shift dates and start shift times.');
        } catch (\Exception $e) {
            // Log any exceptions for debugging
            Log::error('Exception occurred: ' . $e->getMessage());
            Log::error('An error occurred while assigning shift orders based on shift dates and start shift times.');
        }
    }
}
