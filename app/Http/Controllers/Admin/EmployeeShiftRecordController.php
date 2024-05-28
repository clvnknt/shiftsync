<?php

// app/Http/Controllers/Admin/EmployeeShiftRecordController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeShiftRecord;
use App\Models\EmployeeRecord;
use App\Models\EmployeeAssignedShift;
use Illuminate\Http\Request;

class EmployeeShiftRecordController extends Controller
{
    public function index()
    {
        $shiftRecords = EmployeeShiftRecord::with('employeeRecord', 'employeeAssignedShift')->get();
        return view('admins.employee-shift-records.index', compact('shiftRecords'));
    }

    public function create()
    {
        $employeeRecords = EmployeeRecord::all();
        $employeeAssignedShifts = EmployeeAssignedShift::all();

        return view('admins.employee-shift-records.create', compact('employeeRecords', 'employeeAssignedShifts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_record_id' => 'required|exists:employee_records,id',
            'employee_assigned_shift_id' => 'nullable|exists:employee_assigned_shifts,id',
            'shift_date' => 'required|date',
            'end_shift_date' => 'required|date',
            'start_shift' => 'nullable|date',
            'start_lunch' => 'nullable|date',
            'end_lunch' => 'nullable|date',
            'end_shift' => 'nullable|date',
            'hours_rendered' => 'nullable|numeric',
            'shift_order' => 'nullable|integer',
        ]);

        EmployeeShiftRecord::create($request->all());

        return redirect()->route('admins.employee-shift-records.index')->with('success', 'Shift Record created successfully.');
    }

    public function show($id)
    {
        $shiftRecord = EmployeeShiftRecord::with('employeeRecord', 'employeeAssignedShift')->find($id);
        return view('admins.employee-shift-records.show', compact('shiftRecord'));
    }

    public function edit($id)
    {
        $shiftRecord = EmployeeShiftRecord::find($id);
        $employeeRecords = EmployeeRecord::all();
        $employeeAssignedShifts = EmployeeAssignedShift::all();

        return view('admins.employee-shift-records.edit', compact('shiftRecord', 'employeeRecords', 'employeeAssignedShifts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_record_id' => 'required|exists:employee_records,id',
            'employee_assigned_shift_id' => 'nullable|exists:employee_assigned_shifts,id',
            'shift_date' => 'required|date',
            'end_shift_date' => 'required|date',
            'start_shift' => 'nullable|date',
            'start_lunch' => 'nullable|date',
            'end_lunch' => 'nullable|date',
            'end_shift' => 'nullable|date',
            'hours_rendered' => 'nullable|numeric',
            'shift_order' => 'nullable|integer',
        ]);

        $shiftRecord = EmployeeShiftRecord::find($id);
        $shiftRecord->update($request->all());

        return redirect()->route('admins.employee-shift-records.index')->with('success', 'Shift Record updated successfully.');
    }

    public function destroy($id)
    {
        $shiftRecord = EmployeeShiftRecord::find($id);
        $shiftRecord->delete();

        return redirect()->route('admins.employee-shift-records.index')->with('success', 'Shift Record deleted successfully.');
    }
}