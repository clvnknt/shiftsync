<?php

namespace App\Http\Controllers;

use App\Jobs\TimesheetJobs\FetchTimesheetDataJob;
use App\Jobs\TimesheetJobs\FetchCurrentShiftRecordJob;

class TimesheetController extends Controller
{
    public function index()
{
    $userId = auth()->id();

    $timesheetData = FetchTimesheetDataJob::dispatch($userId)->onQueue('timesheet');
    $currentShiftRecord = FetchCurrentShiftRecordJob::dispatch($userId)->onQueue('timesheet');

    return view('employees.timesheet', [
        'timesheetData' => $timesheetData,
        'currentShiftRecord' => $currentShiftRecord,
    ]);
}
}