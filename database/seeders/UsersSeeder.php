<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'CKPa',
                'email' => 'ckpa@cloudstaff.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'VincentG',
                'email' => 'vincentg@cloudstaff.com',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'JohnD',
                'email' => 'johnd@cloudstaff.com',
                'password' => Hash::make('password123'),
                'is_admin' => true, 
            ],
            [
                'name' => 'JaneD',
                'email' => 'janed@cloudstaff.com',
                'password' => Hash::make('password123'),
                'is_admin' => true, 
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}