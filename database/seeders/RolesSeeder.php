<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesSeeder extends Seeder
{

    public function run()
    {
        $roles = [
            [
                'department_id' => 1, // Software Development
                'role_name' => 'Software Engineer',
                'role_description' => 'Develops and maintains software applications.',
            ],
            [
                'department_id' => 2, // Customer Support
                'role_name' => 'Support Specialist',
                'role_description' => 'Provides technical support to customers.',
            ],
        ];

        foreach ($roles as $rolesData) {
            Role::create($rolesData);
        }
    }
}
