<?php

namespace Database\Seeders;

use App\Models\EmployeeRecord;
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
            AddressesSeeder::class,
            EmergencyContactsSeeder::class,
            ShiftBreaksSeeder::class,
            EmployeeRecordsSeeder::class,
        ]);
    }
}