<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\EmployeeRecord;
use App\Models\Address;
use App\Models\EmergencyContact;

class AccountController extends Controller
{
    public function showMyAccount()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Retrieve the user's associated employee record
        $employeeRecord = $user->employeeRecord;

        // Retrieve the user's associated address
        $address = $employeeRecord->address;

        // Retrieve the user's associated emergency contact
        $emergencyContact = $employeeRecord->emergencyContact;

        // Pass the retrieved data to the view
        return view('employees.my_account', [
            'user' => $user,
            'employeeRecord' => $employeeRecord,
            'address' => $address,
            'emergencyContact' => $emergencyContact,
        ]);
    }
}