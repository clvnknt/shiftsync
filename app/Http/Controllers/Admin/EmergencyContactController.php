<?php

// app/Http/Controllers/Admin/EmergencyContactController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmergencyContact;
use Illuminate\Http\Request;

class EmergencyContactController extends Controller
{
    public function index()
    {
        $emergencyContacts = EmergencyContact::all();
        return view('admins.emergency-contacts.index', compact('emergencyContacts'));
    }

    public function create()
    {
        return view('admins.emergency-contacts.create-emergency-contacts');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contact_first_name' => 'required|max:100',
            'contact_last_name' => 'required|max:100',
            'contact_relationship' => 'required|max:50',
            'contact_phone_number' => 'required|max:50',
            'contact_street' => 'required|max:255',
            'contact_city' => 'required|max:100',
            'contact_country' => 'required|max:100',
            'contact_postal_code' => 'required|max:20',
        ]);

        EmergencyContact::create([
            'contact_first_name' => $request->get('contact_first_name'),
            'contact_last_name' => $request->get('contact_last_name'),
            'contact_relationship' => $request->get('contact_relationship'),
            'contact_phone_number' => $request->get('contact_phone_number'),
            'contact_street' => $request->get('contact_street'),
            'contact_city' => $request->get('contact_city'),
            'contact_country' => $request->get('contact_country'),
            'contact_postal_code' => $request->get('contact_postal_code'),
        ]);

        return redirect()->route('admins.emergency-contacts.index')->with('success', 'Emergency contact created successfully.');
    }

    public function show($id)
    {
        $emergencyContact = EmergencyContact::find($id);
        return view('admins.emergency-contacts.read-emergency-contacts', compact('emergencyContact'));
    }

    public function edit($id)
    {
        $emergencyContact = EmergencyContact::find($id);
        return view('admins.emergency-contacts.update-emergency-contacts', compact('emergencyContact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'contact_first_name' => 'required|max:100',
            'contact_last_name' => 'required|max:100',
            'contact_relationship' => 'required|max:50',
            'contact_phone_number' => 'required|max:50',
            'contact_street' => 'required|max:255',
            'contact_city' => 'required|max:100',
            'contact_country' => 'required|max:100',
            'contact_postal_code' => 'required|max:20',
        ]);

        $emergencyContact = EmergencyContact::find($id);
        $emergencyContact->contact_first_name = $request->get('contact_first_name');
        $emergencyContact->contact_last_name = $request->get('contact_last_name');
        $emergencyContact->contact_relationship = $request->get('contact_relationship');
        $emergencyContact->contact_phone_number = $request->get('contact_phone_number');
        $emergencyContact->contact_street = $request->get('contact_street');
        $emergencyContact->contact_city = $request->get('contact_city');
        $emergencyContact->contact_country = $request->get('contact_country');
        $emergencyContact->contact_postal_code = $request->get('contact_postal_code');
        $emergencyContact->save();

        return redirect()->route('admins.emergency-contacts.index')->with('success', 'Emergency contact updated successfully.');
    }

    public function destroy($id)
    {
        $emergencyContact = EmergencyContact::find($id);
        $emergencyContact->delete();

        return redirect()->route('admins.emergency-contacts.index')->with('success', 'Emergency contact deleted successfully.');
    }
}