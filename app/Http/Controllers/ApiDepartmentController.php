<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class ApiDepartmentController extends Controller
{
    public function index()
    {
        return Department::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'department_description' => 'nullable|string',
        ]);
        
        $department = Department::create($request->all());
        return response()->json($department, 201);
    }

    public function show($id)
    {
        return Department::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->update($request->all());
        return response()->json($department, 200);
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return response()->json(null, 204);
    }
}