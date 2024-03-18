<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\EmployeeRecord;
use Illuminate\Support\Facades\Auth;

class FetchDefaultShiftJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function handle()
    {
        // Fetch the default shift associated with the user's employee record
        $employeeRecord = EmployeeRecord::where('user_id', $this->userId)->first();
        $defaultShift = $employeeRecord ? $employeeRecord->defaultShift : null;
        
        // You can handle further processing if required

        return $defaultShift;
    }
}
