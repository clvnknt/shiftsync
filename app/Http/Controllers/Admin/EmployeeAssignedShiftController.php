<?php

// app/Http/Controllers/Admin/EmployeeAssignedShiftController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAssignedShift;
use App\Models\EmployeeRecord;
use App\Models\ShiftSchedule;
use Illuminate\Http\Request;

class EmployeeAssignedShiftController extends Controller
{
    public function index()
    {
        $assignedShifts = EmployeeAssignedShift::with('employeeRecord', 'shiftSchedule')->get();
        return view('admins.employee-assigned-shifts.index', compact('assignedShifts'));
    }

    public function create()
    {
        $employeeRecords = EmployeeRecord::all();
        $shiftSchedules = ShiftSchedule::all();

        return view('admins.employee-assigned-shifts.create-employee-assigned-shift', compact('employeeRecords', 'shiftSchedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_record_id' => 'required|exists:employee_records,id',
            'shift_schedule_id' => 'nullable|exists:shift_schedules,id',
            'is_active' => 'required|boolean',
        ]);

        EmployeeAssignedShift::create($request->all());

        return redirect()->route('admins.employee-assigned-shifts.index')->with('success', 'Shift Assignment created successfully.');
    }

    public function show($id)
    {
        $assignedShift = EmployeeAssignedShift::with('employeeRecord', 'shiftSchedule')->find($id);
        return view('admins.employee-assigned-shifts.read-employee-assigned-shift', compact('assignedShift'));
    }

    public function edit($id)
    {
        $assignedShift = EmployeeAssignedShift::find($id);
        $employeeRecords = EmployeeRecord::all();
        $shiftSchedules = ShiftSchedule::all();

        return view('admins.employee-assigned-shifts.update-employee-assigned-shift', compact('assignedShift', 'employeeRecords', 'shiftSchedules'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_record_id' => 'required|exists:employee_records,id',
            'shift_schedule_id' => 'nullable|exists:shift_schedules,id',
            'is_active' => 'required|boolean',
        ]);

        $assignedShift = EmployeeAssignedShift::find($id);
        $assignedShift->update($request->all());

        return redirect()->route('admins.employee-assigned-shifts.index')->with('success', 'Shift Assignment updated successfully.');
    }

    public function destroy($id)
    {
        $assignedShift = EmployeeAssignedShift::find($id);
        $assignedShift->delete();

        return redirect()->route('admins.employee-assigned-shifts.index')->with('success', 'Shift Assignment deleted successfully.');
    }
}