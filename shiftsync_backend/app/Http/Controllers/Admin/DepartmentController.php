<?php

// app/Http/Controllers/Admin/DepartmentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admins.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admins.departments.create-departments');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required',
            'department_description' => 'nullable'
        ]);

        Department::create([
            'department_name' => $request->get('department_name'),
            'department_description' => $request->get('department_description')
        ]);

        return redirect()->route('admins.departments.index')->with('success', 'Department created successfully.');
    }

    public function show($id)
    {
        $department = Department::find($id);
        return view('admins.departments.read-departments', compact('department'));
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('admins.departments.update-departments', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'department_name' => 'required',
            'department_description' => 'nullable'
        ]);

        $department = Department::find($id);
        $department->department_name = $request->get('department_name');
        $department->department_description = $request->get('department_description');
        $department->save();

        return redirect()->route('admins.departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();

        return redirect()->route('admins.departments.index')->with('success', 'Department deleted successfully.');
    }
}