<?php

// app/Http/Controllers/Admin/EmployeeRecordController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeRecord;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use App\Models\Address;
use App\Models\EmergencyContact;
use Illuminate\Http\Request;

class EmployeeRecordController extends Controller
{
    public function index()
    {
        $employeeRecords = EmployeeRecord::with('user', 'department', 'role', 'address', 'emergencyContact')->get();
        return view('admins.employee-records.index', compact('employeeRecords'));
    }

    public function create()
    {
        $users = User::all();
        $departments = Department::all();
        $roles = Role::all();
        $addresses = Address::all();
        $emergencyContacts = EmergencyContact::all();

        return view('admins.employee-records.create-employee-record', compact('users', 'departments', 'roles', 'addresses', 'emergencyContacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'address_id' => 'required|exists:addresses,id',
            'emergency_contact_id' => 'required|exists:emergency_contacts,id',
            'employee_first_name' => 'required',
            'employee_middle_name' => 'required',
            'employee_last_name' => 'required',
            'employee_suffix' => 'required',
            'employee_gender' => 'required|in:male,female,other',
            'employee_age' => 'required|integer',
            'employee_birthdate' => 'required|date',
            'employee_profile_picture' => 'required|string',
            'employee_timezone' => 'required|string'
        ]);

        EmployeeRecord::create($request->all());

        return redirect()->route('admins.employee-records.index')->with('success', 'Employee Record created successfully.');
    }

    public function show($id)
    {
        $employeeRecord = EmployeeRecord::with('user', 'department', 'role', 'address', 'emergencyContact')->find($id);
        return view('admins.employee-records.read-employee-record', compact('employeeRecord'));
    }

    public function edit($id)
    {
        $employeeRecord = EmployeeRecord::find($id);
        $users = User::all();
        $departments = Department::all();
        $roles = Role::all();
        $addresses = Address::all();
        $emergencyContacts = EmergencyContact::all();

        return view('admins.employee-records.update-employee-record', compact('employeeRecord', 'users', 'departments', 'roles', 'addresses', 'emergencyContacts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'address_id' => 'required|exists:addresses,id',
            'emergency_contact_id' => 'required|exists:emergency_contacts,id',
            'employee_first_name' => 'required',
            'employee_middle_name' => 'required',
            'employee_last_name' => 'required',
            'employee_suffix' => 'required',
            'employee_gender' => 'required|in:male,female,other',
            'employee_age' => 'required|integer',
            'employee_birthdate' => 'required|date',
            'employee_profile_picture' => 'required|string',
            'employee_timezone' => 'required|string'
        ]);

        $employeeRecord = EmployeeRecord::find($id);
        $employeeRecord->update($request->all());

        return redirect()->route('admins.employee-records.index')->with('success', 'Employee Record updated successfully.');
    }

    public function destroy($id)
    {
        $employeeRecord = EmployeeRecord::find($id);
        $employeeRecord->delete();

        return redirect()->route('admins.employee-records.index')->with('success', 'Employee Record deleted successfully.');
    }
}