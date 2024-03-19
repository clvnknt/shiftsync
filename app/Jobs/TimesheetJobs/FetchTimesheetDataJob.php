<?php

namespace App\Jobs\TimesheetJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;
use App\Models\User;

class FetchTimesheetDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function handle()
    {
        $employeeRecord = EmployeeRecord::where('user_id', $this->userId)->first();
        $defaultShift = $employeeRecord ? $employeeRecord->defaultShift : null;

        $shiftNames = EmployeeShiftRecord::where('employee_id', $this->userId)
            ->where('shift_date', '<=', now())
            ->join('shifts', 'employee_shift_records.shift_id', '=', 'shifts.id')
            ->pluck('shifts.shift_name')
            ->unique()
            ->toArray();

        return [
            'user' => User::find($this->userId),
            'employeeRecord' => $employeeRecord,
            'defaultShift' => $defaultShift,
            'shiftNames' => $shiftNames,
        ];
    }
}