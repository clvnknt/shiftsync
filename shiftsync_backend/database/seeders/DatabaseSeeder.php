<?php

namespace Database\Seeders;

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
            EmployeeRecordsSeeder::class,
            AssignedShiftsSeeder::class,
            OvertimeRulesSeeder::class,
            CutoffPeriodsSeeder::class,
        ]);
    }
}