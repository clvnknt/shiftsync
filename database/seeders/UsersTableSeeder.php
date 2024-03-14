<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Seed multiple user accounts
        $users = [
            [
                'name' => 'john',
                'email' => 'john@example.com',
                'timezone' => 'Asia/Manila',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'jane',
                'email' => 'jane@example.com',
                'timezone' => 'Asia/Manila',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'alice',
                'email' => 'alice@example.com',
                'timezone' => 'Asia/Manila',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'bob',
                'email' => 'bob@example.com',
                'timezone' => 'Asia/Manila',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'eva',
                'email' => 'eva@example.com',
                'timezone' => 'Asia/Manila',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the users into the database
        DB::table('users')->insert($users);
    }
}