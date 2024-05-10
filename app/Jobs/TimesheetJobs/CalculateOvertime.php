<?php

namespace App\Jobs\TimesheetJobs;

use App\Models\EmployeeShiftRecord;
use App\Models\Overtime;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateOvertime implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $employeeRecordId;

    /**
     * Create a new job instance.
     *
     * @param int $employeeRecordId
     * @return void
     */
    public function __construct($employeeRecordId)
    {
        $this->employeeRecordId = $employeeRecordId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Retrieve employee shift records for calculation
        $shiftRecords = EmployeeShiftRecord::where('id', $this->employeeRecordId)->get();
    
        // Loop through each shift record for calculation
        foreach ($shiftRecords as $record) {
            // Ensure that all necessary timestamps are available
            if ($record->start_shift && $record->end_shift &&
                $record->employeeAssignedShift && $record->employeeAssignedShift->shiftSchedule) {
                // Calculate the duration of the shift in hours
                $startShift = Carbon::parse($record->start_shift);
                $endShift = Carbon::parse($record->end_shift);
                $shiftDuration = $startShift->floatDiffInHours($endShift);
    
                // Get the employee's regular working hours
                $regularHours = $this->calculateRegularHours($record);
    
                // Calculate overtime hours (shift duration minus regular hours)
                $overtimeHours = max(0, $shiftDuration - $regularHours);
    
                // Store the overtime information in the overtime table
                Overtime::create([
                    'employee_shift_record_id' => $record->id,
                    'overtime_started' => $record->start_shift,
                    'overtime_ended' => $record->end_shift,
                    'overtime_hours' => $overtimeHours,
                ]);
            }
        }
    }

    /**
     * Calculate regular working hours for a given employee shift record.
     *
     * @param  EmployeeShiftRecord  $shiftRecord
     * @return float
     */
    private function calculateRegularHours(EmployeeShiftRecord $shiftRecord): float
    {
        // Get the employee's assigned shift schedule
        $shiftSchedule = $shiftRecord->employeeAssignedShift->shiftSchedule;

        // Calculate regular working hours based on shift schedule
        $startShift = Carbon::createFromTimeString($shiftSchedule->start_shift_time, $shiftSchedule->shift_timezone);
        $endShift = Carbon::createFromTimeString($shiftSchedule->end_shift_time, $shiftSchedule->shift_timezone);
        $lunchStart = Carbon::createFromTimeString($shiftSchedule->lunch_start_time, $shiftSchedule->shift_timezone);
        $lunchEnd = Carbon::createFromTimeString($shiftSchedule->end_lunch_time, $shiftSchedule->shift_timezone);

        // Calculate regular hours (shift duration minus lunch break)
        $regularHours = $startShift->floatDiffInHours($lunchStart) + $lunchEnd->floatDiffInHours($endShift);

        return $regularHours;
    }
}