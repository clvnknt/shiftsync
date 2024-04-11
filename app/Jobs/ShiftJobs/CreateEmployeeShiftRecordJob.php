<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmployeeAssignedShift;
use App\Models\EmployeeShiftRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CreateEmployeeShiftRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $assignedShift;

    /**
     * Create a new job instance.
     *
     * @param EmployeeAssignedShift $assignedShift
     */
    public function __construct(EmployeeAssignedShift $assignedShift)
    {
        $this->assignedShift = $assignedShift;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Get the current date
            $currentDate = Carbon::now()->toDateString();

            // Check if there is no existing shift record for this assigned shift and date
            $existingShiftRecord = EmployeeShiftRecord::where('employee_assigned_shift_id', $this->assignedShift->id)
                ->where('shift_date', $currentDate)
                ->exists();

            // If no existing shift record found, create a new one
            if (!$existingShiftRecord) {
                // Create a new shift record for this assigned shift and date
                EmployeeShiftRecord::create([
                    'shift_date' => $currentDate,
                    'employee_assigned_shift_id' => $this->assignedShift->id,
                    'employee_record_id' => $this->assignedShift->employee_record_id,
                    'start_shift' => null,
                    'start_lunch' => null,
                    'end_lunch' => null,
                    'end_shift' => null,
                ]);

                // Log shift record creation for debugging
                Log::info('Shift record created for Employee ID: ' . $this->assignedShift->employee_record_id);
            }
        } catch (\Exception $e) {
            // Log any exceptions for debugging
            Log::error('Exception occurred: ' . $e->getMessage());
        }
    }
}