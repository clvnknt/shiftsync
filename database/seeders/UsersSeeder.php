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
            ],
            [
                'name' => 'VincentG',
                'email' => 'vincentg@cloudstaff.com',
                'password' => Hash::make('password123'),
            ],
        ];        

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}