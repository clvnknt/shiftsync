<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeRecord;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use App\Models\Address;
use App\Models\EmergencyContact;

class ApiEmployeeRecordController extends Controller
{
    public function index()
    {
        $employeeRecords = EmployeeRecord::with(['user', 'department', 'role', 'address', 'emergencyContact'])->get();
        return response()->json($employeeRecords);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'address_id' => 'required|exists:addresses,id',
            'emergency_contact_id' => 'required|exists:emergency_contacts,id',
            'employee_first_name' => 'required|string|max:255',
            'employee_middle_name' => 'required|string|max:255',
            'employee_last_name' => 'required|string|max:255',
            'employee_suffix' => 'nullable|string|max:255',
            'employee_gender' => 'required|in:male,female,other',
            'employee_age' => 'required|integer|min:0',
            'employee_birthdate' => 'required|date',
            'employee_profile_picture' => 'nullable|string|max:255',
            'employee_timezone' => 'required|string|max:6',
        ]);

        $employeeRecord = EmployeeRecord::create($request->all());
        return response()->json($employeeRecord, 201);
    }

    public function show($id)
    {
        $employeeRecord = EmployeeRecord::with(['user', 'department', 'role', 'address', 'emergencyContact'])->findOrFail($id);
        return response()->json($employeeRecord);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'address_id' => 'required|exists:addresses,id',
            'emergency_contact_id' => 'required|exists:emergency_contacts,id',
            'employee_first_name' => 'required|string|max:255',
            'employee_middle_name' => 'required|string|max:255',
            'employee_last_name' => 'required|string|max:255',
            'employee_suffix' => 'nullable|string|max:255',
            'employee_gender' => 'required|in:male,female,other',
            'employee_age' => 'required|integer|min:0',
            'employee_birthdate' => 'required|date',
            'employee_profile_picture' => 'nullable|string|max:255',
            'employee_timezone' => 'required|string|max:6',
        ]);

        $employeeRecord = EmployeeRecord::findOrFail($id);
        $employeeRecord->update($request->all());
        return response()->json($employeeRecord);
    }

    public function destroy($id)
    {
        $employeeRecord = EmployeeRecord::findOrFail($id);
        $employeeRecord->delete();
        return response()->json(null, 204);
    }
}