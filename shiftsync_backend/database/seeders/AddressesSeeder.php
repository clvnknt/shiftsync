<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;


class AddressesSeeder extends Seeder
{
    public function run(): void
    {
        $addresses = [
            [
                'employee_street' => '123 Main Street',
                'employee_city' => 'CityA',
                'employee_country' => 'CountryX',
                'employee_postal_code' => '12345',
                'type' => 'primary',
            ],
            [
                'employee_street' => '456 Park Avenue',
                'employee_city' => 'CityB',
                'employee_country' => 'CountryY',
                'employee_postal_code' => '67890',
                'type' => 'primary',
            ],
        ];
        
        foreach ($addresses as $addressData) {
            Address::create($addressData);
        }
    }
}
