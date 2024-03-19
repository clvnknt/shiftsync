<?php

namespace App\Jobs\DashboardJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;

class EnsureUserShiftRecordExistsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $employeeRecord = EmployeeRecord::where('user_id', $this->userId)->first();

        if ($employeeRecord) {
            $today = now()->timezone(Auth::user()->timezone)->toDateString();
            $employeeShiftRecord = EmployeeShiftRecord::where('employee_id', $this->userId)
                ->whereDate('shift_date', $today)
                ->first();

            if (!$employeeShiftRecord) {
                // Create a new shift record for the user for today
                $employeeShiftRecord = new EmployeeShiftRecord();
                $employeeShiftRecord->employee_id = $this->userId;
                $employeeShiftRecord->shift_date = $today;
                // Set other attributes as needed
                $employeeShiftRecord->save();
            }
        }
    }
}
