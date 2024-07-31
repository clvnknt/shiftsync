<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeAssignedShift;

class ApiEmployeeAssignedShiftController extends Controller
{
    public function index()
    {
        // Eager load employeeRecord and shiftSchedule relationships
        return EmployeeAssignedShift::with(['employeeRecord', 'shiftSchedule'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_record_id' => 'required|exists:employee_records,id',
            'shift_schedule_id' => 'nullable|exists:shift_schedules,id',
            'is_active' => 'boolean'
        ]);

        $assignedShift = EmployeeAssignedShift::create($request->all());
        return response()->json($assignedShift, 201);
    }

    public function show($id)
    {
        // Eager load employeeRecord and shiftSchedule relationships
        return EmployeeAssignedShift::with(['employeeRecord', 'shiftSchedule'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_record_id' => 'required|exists:employee_records,id',
            'shift_schedule_id' => 'nullable|exists:shift_schedules,id',
            'is_active' => 'boolean'
        ]);

        $assignedShift = EmployeeAssignedShift::findOrFail($id);
        $assignedShift->update($request->all());
        return response()->json($assignedShift);
    }

    public function destroy($id)
    {
        EmployeeAssignedShift::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}