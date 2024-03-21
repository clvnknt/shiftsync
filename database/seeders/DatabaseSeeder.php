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
            ShiftsSeeder::class,
            EmployeeRecordsSeeder::class,
            EmployeeShiftRecordsSeeder::class,
            RulesSeeder::class,
            HolidaysSeeder::class,
            BreaksSeeder::class,
            EmergencyContactsSeeder::class,
            AddressesSeeder::class,
        ]);
    }
}