<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\EnsureUserShiftRecordExistsJob;
use App\Models\EmployeeRecord;
use App\Models\User;
use App\Models\EmployeeShiftRecord;

class DashboardController extends Controller
{
    public function show()
    {
        $userId = Auth::id();
        $employeeRecord = EmployeeRecord::where('user_id', $userId)->first();
        
        if (!$employeeRecord) {
            return redirect()->back()->with('error', 'Employee record not found.');
        }
        
        EnsureUserShiftRecordExistsJob::dispatch($userId);
        $employeeShift = $this->getEmployeeShiftRecord($userId);
        
        return view('employees.dashboard', [
            'user' => Auth::user(),
            'employeeRecord' => $employeeRecord,
            'employeeShift' => $employeeShift,
        ]);        
    }

    private function getEmployeeShiftRecord($userId)
    {
        return EmployeeShiftRecord::where('employee_id', $userId)
            ->whereDate('shift_date', now()->timezone(Auth::user()->timezone)->toDateString())
            ->first();
    }
}