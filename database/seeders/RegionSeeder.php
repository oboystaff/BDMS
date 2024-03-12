<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $regions = [
            'North East',
            'Upper West',
            'Savanna',
            'Upper East',
            'Northern',
            'Eastern',
            'Bono East',
            'Bono',
            'Ahafo',
            'Central',
            'Western',
            'Oti',
            'Volta',
            'Ashanti',
            'Greater Accra',
            'Western North',
        ];

        $zone_ids = [
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
            '77faa8cf-a807-45d1-9328-991c2738ba40',
        ];

        // Create a collection from the given arrays
        $collection = collect(array_map(null, $regions, $zone_ids));

        $collection->each(function ($item) {
            $region = $item[0];
            $id = $item[1];

            Region::firstOrCreate(['name' => $region, 'zone_id' => $id]);
        });
    }
}
