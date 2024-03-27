<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\EmployeeRecord;
use App\Models\EmployeeShiftRecord;


class StartShiftJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = Auth::user();
        $employeeRecord = EmployeeRecord::where('user_id', $user->id)->first();
        $existingShiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
            ->whereDate('shift_date', Carbon::today())
            ->first();

        if (!$existingShiftRecord) {
            $shiftRecord = new EmployeeShiftRecord();
            $shiftRecord->employee_record_id = $employeeRecord->id;
            $shiftRecord->shift_date = Carbon::now()->toDateString();
            $shiftRecord->start_shift = Carbon::now();
            $shiftRecord->save();
        }
    }
}
