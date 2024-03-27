<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ShiftJobs\StartShiftJob;
use App\Jobs\ShiftJobs\StartLunchJob;
use App\Jobs\ShiftJobs\EndLunchJob;
use App\Jobs\ShiftJobs\EndShiftJob;

class ShiftController extends Controller
{
    public function startShift(Request $request)
    {
        StartShiftJob::dispatch();
        return response()->json(['message' => 'Shift started successfully'], 200);
    }

    public function startLunch(Request $request)
    {
        StartLunchJob::dispatch();
        return response()->json(['message' => 'Lunch break started successfully'], 200);
    }

    public function endLunch(Request $request)
    {
        EndLunchJob::dispatch();
        return response()->json(['message' => 'Lunch break ended successfully'], 200);
    }

    public function endShift(Request $request)
    {
        EndShiftJob::dispatch();
        return response()->json(['message' => 'Shift ended successfully'], 200);
    }
}
