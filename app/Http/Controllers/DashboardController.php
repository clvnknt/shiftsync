<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\DashboardJobs\EnsureUserShiftRecordExistsJob;
use App\Jobs\DashboardJobs\GetEmployeeShiftRecordJob;
use App\Models\EmployeeRecord;

class DashboardController extends Controller
{
    public function show()
    {
        $userId = Auth::id();
        $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();

        if (!$employeeRecord) {
            return redirect()->back()->with('error', 'Employee record not found.');
        }

        // Dispatch the jobs synchronously
        $ensureJob = new EnsureUserShiftRecordExistsJob($userId);
        $ensureJob->handle();

        $getJob = new GetEmployeeShiftRecordJob($userId);
        $employeeShift = $getJob->handle();

        return view('employees.dashboard', [
            'user' => Auth::user(),
            'employeeRecord' => $employeeRecord,
            'employeeShift' => $employeeShift,
        ]);
    }
}

