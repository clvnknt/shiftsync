<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmergencyContact;

class EmergencyContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emergencyContacts = [
            [
                'contact_first_name' => 'Emergency',
                'contact_last_name' => 'Contact1',
                'contact_relationship' => 'Parent',
                'contact_phone_number' => '123-456-7890',
                'contact_street' => '789 Elm Street',
                'contact_city' => 'CityC',
                'contact_country' => 'CountryZ',
                'contact_postal_code' => '54321',
            ],
            [
                'contact_first_name' => 'Emergency',
                'contact_last_name' => 'Contact2',
                'contact_relationship' => 'Spouse',
                'contact_phone_number' => '987-654-3210',
                'contact_street' => '321 Oak Street',
                'contact_city' => 'CityD',
                'contact_country' => 'CountryZ',
                'contact_postal_code' => '98765',
            ],
        ];

        foreach ($emergencyContacts as $emergencyContactData) {
            EmergencyContact::create($emergencyContactData);
        }
    }
}