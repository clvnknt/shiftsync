<?php

// app/Http/Controllers/Admin/RoleController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('department')->get();
        return view('admins.roles.index', compact('roles'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admins.roles.create-roles', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'role_name' => 'required',
            'role_description' => 'nullable',
        ]);

        Role::create([
            'department_id' => $request->get('department_id'),
            'role_name' => $request->get('role_name'),
            'role_description' => $request->get('role_description'),
        ]);

        return redirect()->route('admins.roles.index')->with('success', 'Role created successfully.');
    }

    public function show($id)
    {
        $role = Role::with('department')->find($id);
        return view('admins.roles.read-roles', compact('role'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $departments = Department::all();
        return view('admins.roles.update-roles', compact('role', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'role_name' => 'required',
            'role_description' => 'nullable',
        ]);

        $role = Role::find($id);
        $role->department_id = $request->get('department_id');
        $role->role_name = $request->get('role_name');
        $role->role_description = $request->get('role_description');
        $role->save();

        return redirect()->route('admins.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect()->route('admins.roles.index')->with('success', 'Role deleted successfully.');
    }
}