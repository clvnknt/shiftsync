<?php

// app/Http/Controllers/Admin/UserController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admins.users.index', compact('users'));
    }

    public function create()
    {
        return view('admins.users.create-users');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = New User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'is_admin' => $request->get('is_admin') ? true : false,
        ]);
        
        $user->save();

        return redirect()->route('admins.users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admins.users.read-users', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admins.users.update-users', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->is_admin = $request->get('is_admin') ? true : false;
        $user->save();

        return redirect()->route('admins.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admins.users.index')->with('success', 'User deleted successfully.');
    }
}