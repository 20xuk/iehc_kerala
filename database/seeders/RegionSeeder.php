<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Country;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get country IDs
        $india = Country::where('code', 'IND')->first();
        $usa = Country::where('code', 'USA')->first();
        $uk = Country::where('code', 'GBR')->first();
        $canada = Country::where('code', 'CAN')->first();
        $australia = Country::where('code', 'AUS')->first();

        $regions = [
            // India regions
            [
                'name' => 'Kerala',
                'code' => 'KL',
                'country_id' => $india ? $india->id : null,
                'description' => 'God\'s Own Country',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Tamil Nadu',
                'code' => 'TN',
                'country_id' => $india ? $india->id : null,
                'description' => 'Land of Temples',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Karnataka',
                'code' => 'KA',
                'country_id' => $india ? $india->id : null,
                'description' => 'One State Many Worlds',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Maharashtra',
                'code' => 'MH',
                'country_id' => $india ? $india->id : null,
                'description' => 'Gateway of India',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Delhi',
                'code' => 'DL',
                'country_id' => $india ? $india->id : null,
                'description' => 'Heart of India',
                'is_active' => true,
                'sort_order' => 5,
            ],

            // USA regions
            [
                'name' => 'California',
                'code' => 'CA',
                'country_id' => $usa ? $usa->id : null,
                'description' => 'The Golden State',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'New York',
                'code' => 'NY',
                'country_id' => $usa ? $usa->id : null,
                'description' => 'The Empire State',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Texas',
                'code' => 'TX',
                'country_id' => $usa ? $usa->id : null,
                'description' => 'The Lone Star State',
                'is_active' => true,
                'sort_order' => 3,
            ],

            // UK regions
            [
                'name' => 'England',
                'code' => 'ENG',
                'country_id' => $uk ? $uk->id : null,
                'description' => 'Land of Hope and Glory',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Scotland',
                'code' => 'SCT',
                'country_id' => $uk ? $uk->id : null,
                'description' => 'Land of the Brave',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Wales',
                'code' => 'WLS',
                'country_id' => $uk ? $uk->id : null,
                'description' => 'Land of Song',
                'is_active' => true,
                'sort_order' => 3,
            ],

            // Canada regions
            [
                'name' => 'Ontario',
                'code' => 'ON',
                'country_id' => $canada ? $canada->id : null,
                'description' => 'Yours to Discover',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Quebec',
                'code' => 'QC',
                'country_id' => $canada ? $canada->id : null,
                'description' => 'Je me souviens',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'British Columbia',
                'code' => 'BC',
                'country_id' => $canada ? $canada->id : null,
                'description' => 'Super Natural',
                'is_active' => true,
                'sort_order' => 3,
            ],

            // Australia regions
            [
                'name' => 'New South Wales',
                'code' => 'NSW',
                'country_id' => $australia ? $australia->id : null,
                'description' => 'First State',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Victoria',
                'code' => 'VIC',
                'country_id' => $australia ? $australia->id : null,
                'description' => 'The Place to Be',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Queensland',
                'code' => 'QLD',
                'country_id' => $australia ? $australia->id : null,
                'description' => 'Beautiful One Day, Perfect the Next',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($regions as $region) {
            if ($region['country_id']) {
                Region::updateOrCreate(
                    ['code' => $region['code'], 'country_id' => $region['country_id']],
                    $region
                );
            }
        }
    }
}
