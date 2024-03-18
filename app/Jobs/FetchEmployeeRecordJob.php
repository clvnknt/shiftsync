<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\EmployeeRecord;
use Illuminate\Support\Facades\Auth;

class FetchEmployeeRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function handle()
    {
        // Fetch the user's employee record
        $employeeRecord = EmployeeRecord::where('user_id', $this->userId)->first();
        
        // You can handle further processing if required

        return $employeeRecord;
    }
}
