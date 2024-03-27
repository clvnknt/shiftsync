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
class StartLunchJob implements ShouldQueue
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
        $shiftRecord = EmployeeShiftRecord::where('employee_record_id', $employeeRecord->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $shiftRecord->start_lunch = Carbon::now();
        $shiftRecord->save();
    }
}
