<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmployeeShiftRecord;

class EndShiftJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $currentShiftRecordId;
    public $nextShiftRecordId;

    /**
     * Create a new job instance.
     *
     * @param int $currentShiftRecordId
     * @param int $nextShiftRecordId
     * @return void
     */
    public function __construct($currentShiftRecordId, $nextShiftRecordId)
    {
        $this->currentShiftRecordId = $currentShiftRecordId;
        $this->nextShiftRecordId = $nextShiftRecordId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Retrieve the current shift record
        $currentShiftRecord = EmployeeShiftRecord::find($this->currentShiftRecordId);

        // Check if the current shift record exists and if the end_shift field is not already set
        if ($currentShiftRecord && !$currentShiftRecord->end_shift) {
            // Update the end_shift field
            $currentShiftRecord->end_shift = now();
            $currentShiftRecord->save();
        }
    }
}