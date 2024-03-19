<?php

namespace App\Jobs\DashboardJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmployeeShiftRecord;
use Illuminate\Support\Facades\Auth;

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
        return EmployeeShiftRecord::where('employee_id', $this->userId)
            ->whereDate('shift_date', now()->timezone(Auth::user()->timezone)->toDateString())
            ->first();
    }
}
