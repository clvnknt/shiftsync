<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Jobs\ShiftJobs\{
    UpdateShiftRecordJob,
    StartShiftJob,
    EndShiftJob,
    StartLunchJob,
    EndLunchJob,
    EnsureShiftRecordExistsJob
};

class ShiftController extends Controller
{
    public function updateShiftRecord($userId)
    {
        UpdateShiftRecordJob::dispatch($userId);
    }

    public function startShift()
    {
        $userId = Auth::id();
        $this->updateShiftRecord($userId);
        StartShiftJob::dispatch($userId);
        return redirect()->back();
    }

    public function endShift()
    {
        $userId = Auth::id();
        $this->updateShiftRecord($userId);
        EndShiftJob::dispatch($userId);
        return redirect()->back();
    }

    public function startLunch()
    {
        $userId = Auth::id();
        $this->updateShiftRecord($userId);
        StartLunchJob::dispatch($userId);
        return redirect()->back();
    }

    public function endLunch()
    {
        $userId = Auth::id();
        $this->updateShiftRecord($userId);
        EndLunchJob::dispatch($userId);
        return redirect()->back();
    }

    public function ensureShiftRecordExists($userId)
    {
        EnsureShiftRecordExistsJob::dispatch($userId);
    }
}