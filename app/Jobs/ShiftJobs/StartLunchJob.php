<?php

namespace App\Jobs\ShiftJobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmployeeShiftRecord;

class StartLunchJob implements ShouldQueue
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

        // Check if the current shift record exists and if the start_lunch field is not already set
        if ($currentShiftRecord && !$currentShiftRecord->start_lunch) {
            // Update the start_lunch field
            $currentShiftRecord->start_lunch = now();
            $currentShiftRecord->save();

            // Trigger the next job to update the next shift record
            EndLunchJob::dispatch($currentShiftRecord->id, $this->nextShiftRecordId);
        }
    }
}