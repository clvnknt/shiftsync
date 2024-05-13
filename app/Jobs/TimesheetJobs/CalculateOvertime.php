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
                
                // Convert shift end time from shift schedule to UTC
                $shiftSchedule = $record->employeeAssignedShift->shiftSchedule;
                $shiftEndTime = Carbon::createFromTimeString($shiftSchedule->end_shift_time, $shiftSchedule->shift_timezone)
                                     ->setTimezone('UTC');

                // Store the actual end shift time
                $actualEndShiftTime = Carbon::parse($record->end_shift);

                // Calculate overtime based on the difference between actual end shift time and shift end time from schedule
                $overtimeDuration = max(0, $actualEndShiftTime->floatDiffInHours($shiftEndTime));

                // Store the overtime information in the overtime table
                Overtime::create([
                    'employee_shift_record_id' => $record->id,
                    'overtime_started' => $shiftEndTime, // Overtime started is the end shift time in the shift schedule
                    'overtime_ended' => $actualEndShiftTime, // Overtime ended is the actual employee shift record end shift
                    'overtime_hours' => $overtimeDuration,
                ]);
            }

            //Overtime Duration = Actual End Shift Time − Shift End Time from Schedule
        }
    }
}
