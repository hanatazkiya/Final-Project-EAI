<?php

namespace Database\Seeders;

use App\Models\PlaceFeatures;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlaceFeatures::create([
            'place_id' => 1,
            'feature' => 'Toilet',
        ]);

        PlaceFeatures::create([
            'place_id' => 1,
            'feature' => 'Mushola',
        ]);

        PlaceFeatures::create([
            'place_id' => 1,
            'feature' => 'Parkir',
        ]);

        PlaceFeatures::create([
            'place_id' => 2,
            'feature' => 'Toilet',
        ]);

        PlaceFeatures::create([
            'place_id' => 2,
            'feature' => 'Mushola',
        ]);

        PlaceFeatures::create([
            'place_id' => 2,
            'feature' => 'Parkir',
        ]);

        PlaceFeatures::create([
            'place_id' => 3,
            'feature' => 'Toilet',
        ]);

        PlaceFeatures::create([
            'place_id' => 3,
            'feature' => 'Mushola',
        ]);

        PlaceFeatures::create([
            'place_id' => 3,
            'feature' => 'Parkir',
        ]);

        PlaceFeatures::create([
            'place_id' => 4,
            'feature' => 'Toilet',
        ]);

        PlaceFeatures::create([
            'place_id' => 4,
            'feature' => 'Mushola',
        ]);

        PlaceFeatures::create([
            'place_id' => 4,
            'feature' => 'Parkir',
        ]);

        PlaceFeatures::create([
            'place_id' => 5,
            'feature' => 'Toilet',
        ]);

        PlaceFeatures::create([
            'place_id' => 5,
            'feature' => 'Mushola',
        ]);

        PlaceFeatures::create([
            'place_id' => 5,
            'feature' => 'Parkir',
        ]);
    }
}
