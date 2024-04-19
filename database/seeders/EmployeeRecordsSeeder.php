<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeRecord;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use App\Models\Address;
use App\Models\EmergencyContact;
use App\Models\ShiftBreak;

class EmployeeRecordsSeeder extends Seeder
{
    public function run(): void
    {
        // Retrieve users CKPa and VincentG
        $userCKPa = User::where('email', 'ckpa@cloudstaff.com')->first();
        $userVincentG = User::where('email', 'vincentg@cloudstaff.com')->first();
        $userJohnDoe = User::where('email', 'johnd@cloudstaff.com')->first();
        $userJaneDoe = User::where('email', 'janed@cloudstaff.com')->first();

        // Assuming you have only one department, role, address, and emergency contact available
        $department = Department::first();
        $role = Role::first();
        $address = Address::first();
        $emergencyContact = EmergencyContact::first();
        $shiftBreak = ShiftBreak::first();

        // Create employee record for CKPa
        EmployeeRecord::create([
            'user_id' => $userCKPa->id,
            'department_id' => $department->id,
            'role_id' => $role->id,
            'address_id' => $address->id,
            'emergency_contact_id' => $emergencyContact->id,
            'shift_break_id' => $shiftBreak->id,
            'employee_first_name' => 'Calvin Kent',
            'employee_middle_name' => 'Roman', // Adjust as needed
            'employee_last_name' => 'Pamandanan', // Adjust as needed
            'employee_suffix' => '', // Adjust as needed
            'employee_gender' => 'male', // Assuming male as default, adjust as needed
            'employee_age' => 21, // Adjust as needed
            'employee_birthdate' => '2002-05-21', // Adjust as needed
            'employee_profile_picture' => '', // Adjust as needed
            'employee_timezone' => '+08:00',
        ]);

        // Create employee record for VincentG
        EmployeeRecord::create([
            'user_id' => $userVincentG->id,
            'department_id' => $department->id,
            'role_id' => $role->id,
            'address_id' => $address->id,
            'emergency_contact_id' => $emergencyContact->id,
            'shift_break_id' => $shiftBreak->id,
            'employee_first_name' => 'Vincent Kurt',
            'employee_middle_name' => '', // Adjust as needed
            'employee_last_name' => 'Gonzales', // Adjust as needed
            'employee_suffix' => '', // Adjust as needed
            'employee_gender' => 'male', // Assuming male as default, adjust as needed
            'employee_age' => 27, // Adjust as needed
            'employee_birthdate' => '1994-01-01', // Adjust as needed
            'employee_profile_picture' => '', // Adjust as needed
            'employee_timezone' => '+10:00',
        ]);

        // Create employee record for JohnDoe
        if ($userJohnDoe) {
            EmployeeRecord::create([
                'user_id' => $userJohnDoe->id,
                'department_id' => $department->id,
                'role_id' => $role->id,
                'address_id' => $address->id,
                'emergency_contact_id' => $emergencyContact->id,
                'shift_break_id' => $shiftBreak->id,
                'employee_first_name' => 'John',
                'employee_middle_name' => 'Doe', // Adjust as needed
                'employee_last_name' => 'Doe', // Adjust as needed
                'employee_suffix' => '', // Adjust as needed
                'employee_gender' => 'male', // Assuming male as default, adjust as needed
                'employee_age' => 30, // Adjust as needed
                'employee_birthdate' => '1992-01-01', // Adjust as needed
                'employee_profile_picture' => '', // Adjust as needed
                'employee_timezone' => '+01:00',
            ]);
        }

        // Create employee record for JaneDoe
        if ($userJaneDoe) {
            EmployeeRecord::create([
                'user_id' => $userJaneDoe->id,
                'department_id' => $department->id,
                'role_id' => $role->id,
                'address_id' => $address->id,
                'emergency_contact_id' => $emergencyContact->id,
                'shift_break_id' => $shiftBreak->id,
                'employee_first_name' => 'Jane',
                'employee_middle_name' => 'Doe', // Adjust as needed
                'employee_last_name' => 'Doe', // Adjust as needed
                'employee_suffix' => '', // Adjust as needed
                'employee_gender' => 'female', // Assuming female as default, adjust as needed
                'employee_age' => 28, // Adjust as needed
                'employee_birthdate' => '1993-01-01', // Adjust as needed
                'employee_profile_picture' => '', // Adjust as needed
                'employee_timezone' => '-04:00',
            ]);
        }
    }
}
