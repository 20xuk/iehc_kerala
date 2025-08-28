<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'India',
                'code' => 'IND',
                'phone_code' => '+91',
                'currency_code' => 'INR',
                'currency_symbol' => '₹',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'United States',
                'code' => 'USA',
                'phone_code' => '+1',
                'currency_code' => 'USD',
                'currency_symbol' => '$',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'United Kingdom',
                'code' => 'GBR',
                'phone_code' => '+44',
                'currency_code' => 'GBP',
                'currency_symbol' => '£',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Canada',
                'code' => 'CAN',
                'phone_code' => '+1',
                'currency_code' => 'CAD',
                'currency_symbol' => 'C$',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Australia',
                'code' => 'AUS',
                'phone_code' => '+61',
                'currency_code' => 'AUD',
                'currency_symbol' => 'A$',
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['code' => $country['code']],
                $country
            );
        }
    }
}
