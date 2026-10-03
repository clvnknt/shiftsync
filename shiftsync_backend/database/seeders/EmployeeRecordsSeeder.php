<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeRecord;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use App\Models\Address;
use App\Models\EmergencyContact;

class EmployeeRecordsSeeder extends Seeder
{
    public function run(): void
    {
        // Retrieve users
        $userAliceS = User::where('email', 'alices@example.com')->first();
        $userBobJ = User::where('email', 'bobj@example.com')->first();
        $userJohnDoe = User::where('email', 'johnd@example.com')->first();
        $userJaneDoe = User::where('email', 'janed@example.com')->first();
        $department = Department::first();
        $role = Role::first();
        $address = Address::first();
        $emergencyContact = EmergencyContact::first();

        // Create employee record for AliceS
        EmployeeRecord::create([
            'user_id' => $userAliceS->id,
            'department_id' => $department->id,
            'role_id' => $role->id,
            'address_id' => $address->id,
            'emergency_contact_id' => $emergencyContact->id,
            'employee_first_name' => 'Alice',
            'employee_middle_name' => 'Marie', // Adjust as needed
            'employee_last_name' => 'Smith', // Adjust as needed
            'employee_suffix' => '', // Adjust as needed
            'employee_gender' => 'male', // Assuming male as default, adjust as needed
            'employee_age' => 21, // Adjust as needed
            'employee_birthdate' => '2002-05-21', // Adjust as needed
            'employee_profile_picture' => '', // Adjust as needed
            'employee_timezone' => '+08:00',
        ]);

        // Create employee record for BobJ
        EmployeeRecord::create([
            'user_id' => $userBobJ->id,
            'department_id' => $department->id,
            'role_id' => $role->id,
            'address_id' => $address->id,
            'emergency_contact_id' => $emergencyContact->id,
            'employee_first_name' => 'Bob',
            'employee_middle_name' => '', 
            'employee_last_name' => 'Johnson', 
            'employee_suffix' => '', 
            'employee_gender' => 'male', 
            'employee_age' => 27, 
            'employee_birthdate' => '1994-01-01', 
            'employee_profile_picture' => '', 
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
                'employee_first_name' => 'John',
                'employee_middle_name' => 'Doe', 
                'employee_last_name' => 'Doe', 
                'employee_suffix' => '', 
                'employee_gender' => 'male', 
                'employee_age' => 30, 
                'employee_birthdate' => '1992-01-01', 
                'employee_profile_picture' => '', 
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
                'employee_first_name' => 'Jane',
                'employee_middle_name' => 'Doe', 
                'employee_last_name' => 'Doe', 
                'employee_suffix' => '', 
                'employee_gender' => 'female', 
                'employee_age' => 28, 
                'employee_birthdate' => '1993-01-01', 
                'employee_profile_picture' => '', 
                'employee_timezone' => '-04:00',
            ]);
        }
    }
}
