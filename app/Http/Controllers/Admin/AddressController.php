<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::all();
        return view('admins.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('admins.addresses.create-address');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_street' => 'required|max:255',
            'employee_city' => 'required|max:100',
            'employee_country' => 'required|max:100',
            'employee_postal_code' => 'required|max:20',
            'type' => 'required|in:primary,temporary',
        ]);

        Address::create([
            'employee_street' => $request->get('employee_street'),
            'employee_city' => $request->get('employee_city'),
            'employee_country' => $request->get('employee_country'),
            'employee_postal_code' => $request->get('employee_postal_code'),
            'type' => $request->get('type'),
        ]);

        return redirect()->route('admins.addresses.index')->with('success', 'Address created successfully.');
    }

    public function show($id)
    {
        $address = Address::find($id);
        return view('admins.addresses.read-address', compact('address'));
    }

    public function edit($id)
    {
        $address = Address::find($id);
        return view('admins.addresses.update-address', compact('address'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_street' => 'required|max:255',
            'employee_city' => 'required|max:100',
            'employee_country' => 'required|max:100',
            'employee_postal_code' => 'required|max:20',
            'type' => 'required|in:primary,temporary',
        ]);

        $address = Address::find($id);
        $address->employee_street = $request->get('employee_street');
        $address->employee_city = $request->get('employee_city');
        $address->employee_country = $request->get('employee_country');
        $address->employee_postal_code = $request->get('employee_postal_code');
        $address->type = $request->get('type');
        $address->save();

        return redirect()->route('admins.addresses.index')->with('success', 'Address updated successfully.');
    }

    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();

        return redirect()->route('admins.addresses.index')->with('success', 'Address deleted successfully.');
    }
}