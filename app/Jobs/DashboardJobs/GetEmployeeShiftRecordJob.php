<?php

namespace App\Jobs\DashboardJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeShiftRecord;
use Illuminate\Support\Carbon;

class GetEmployeeShiftRecordJob implements ShouldQueue
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
    public function handle()
    {
        $user = Auth::user();
        $today = Carbon::now($user->timezone)->toDateString();
        
        return EmployeeShiftRecord::where('employee_id', $user->id)
            ->where('shift_date', $today)
            ->first();
    }
}
