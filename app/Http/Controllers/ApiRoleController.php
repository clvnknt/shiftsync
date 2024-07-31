<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Department;

class ApiRoleController extends Controller
{
    public function index()
    {
        return Role::with('department')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string',
        ]);
        
        $role = Role::create($request->all());
        return response()->json($role->load('department'), 201);
    }

    public function show($id)
    {
        return Role::with('department')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'role_name' => 'required|string|max:255',
            'role_description' => 'nullable|string',
        ]);
        
        $role->update($request->all());
        return response()->json($role->load('department'), 200);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(null, 204);
    }
}