<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeRecord;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use App\Models\Address;
use App\Models\EmergencyContact;
use App\Models\Shift;
use App\Models\ShiftBreak;

class EmployeeRecordsSeeder extends Seeder
{
    public function run(): void
    {
        // Retrieve users CKPa and VincentG
        $userCKPa = User::where('email', 'ckpa@cloudstaff.com')->first();
        $userVincentG = User::where('email', 'vincentg@cloudstaff.com')->first();

        // Assuming you have only one department, role, address, emergency contact, shift, and shift break available
        $department = Department::first();
        $role = Role::first();
        $address = Address::first();
        $emergencyContact = EmergencyContact::first();
        $shift = Shift::first();
        $shiftBreak = ShiftBreak::first();

        // Create employee record for CKPa
        EmployeeRecord::create([
            'user_id' => $userCKPa->id,
            'department_id' => $department->id,
            'role_id' => $role->id,
            'address_id' => $address->id,
            'emergency_contact_id' => $emergencyContact->id,
            'shift_id' => $shift->id,
            'shift_break_id' => $shiftBreak->id,
            'employee_first_name' => 'Calvin Kent',
            'employee_middle_name' => 'Roman', // Adjust as needed
            'employee_last_name' => 'Pamandanan', // Adjust as needed
            'employee_suffix' => '', // Adjust as needed
            'employee_gender' => 'male', // Assuming male as default, adjust as needed
            'employee_age' => 21, // Adjust as needed
            'employee_birthdate' => '2002-05-21', // Adjust as needed
            'employee_profile_picture' => '', // Adjust as needed
        ]);

        // Create employee record for VincentG
        EmployeeRecord::create([
            'user_id' => $userVincentG->id,
            'department_id' => $department->id,
            'role_id' => $role->id,
            'address_id' => $address->id,
            'emergency_contact_id' => $emergencyContact->id,
            'shift_id' => $shift->id,
            'shift_break_id' => $shiftBreak->id,
            'employee_first_name' => 'Vincent Kurt',
            'employee_middle_name' => '', // Adjust as needed
            'employee_last_name' => 'Gonzales', // Adjust as needed
            'employee_suffix' => '', // Adjust as needed
            'employee_gender' => 'male', // Assuming male as default, adjust as needed
            'employee_age' => 2, // Adjust as needed
            'employee_birthdate' => '1994-01-01', // Adjust as needed
            'employee_profile_picture' => '', // Adjust as needed
        ]);
    }
}
