<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'department_name' => 'Finance',
                'department_description' => 'Responsible for financial activities and management.',
                'created_at' => now(),
            ],
            [
                'department_name' => 'Human Resources',
                'department_description' => 'Handles recruitment, employee relations, and benefits administration.',
                'created_at' => now(),
            ],
            [
                'department_name' => 'IT',
                'department_description' => 'Manages technology infrastructure and systems.',
                'created_at' => now(),
            ],
            [
                'department_name' => 'Operations',
                'department_description' => 'Oversees day-to-day operations and process management.',
                'created_at' => now(),
            ],
            [
                'department_name' => 'Customer Service',
                'department_description' => 'Provides support and assistance to customers.',
                'created_at' => now(),
            ],
        ];

        DB::table('departments')->insert($departments);
    }
}
