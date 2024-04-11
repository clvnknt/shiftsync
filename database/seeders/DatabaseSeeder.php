<?php

namespace Database\Seeders;

use App\Models\EmployeeRecord;
use AssignedShiftsSeeder;
use Database\Seeders\AssignedShiftsSeeder as SeedersAssignedShiftsSeeder;
use Illuminate\Database\Seeder; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            DepartmentsSeeder::class,
            RolesSeeder::class,
            ShiftSchedulesSeeder::class,
            AddressesSeeder::class,
            EmergencyContactsSeeder::class,
            ShiftBreaksSeeder::class,
            EmployeeRecordsSeeder::class,
            RulesSeeder::class,
            SeedersAssignedShiftsSeeder::class,
        ]);
    }
}