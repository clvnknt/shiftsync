<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class EmployeeRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employee_records')->insert([
            'user_id' => 1, // Assuming user with ID 1 exists
            'first_name' => 'Jane',
            'middle_name' => 'Doe',
            'last_name' => 'Smith',
            'default_shift_id' => 1, // Assuming shift with ID 1 exists
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
