<?php

namespace Database\Seeders;

use App\Models\PlaceImages;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlaceImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlaceImages::create([
            'place_id' => 1,
            'filename' => 'images/body/highlight-image-1.png',
        ]);

        PlaceImages::create([
            'place_id' => 2,
            'filename' => 'images/body/highlight-image-2.png',
        ]);

        PlaceImages::create([
            'place_id' => 3,
            'filename' => 'images/body/highlight-image-3.png',
        ]);

        PlaceImages::create([
            'place_id' => 4,
            'filename' => 'images/body/highlight-image-4.png',
        ]);

        PlaceImages::create([
            'place_id' => 5,
            'filename' => 'images/body/highlight-image-5.png',
        ]);
    }
}
