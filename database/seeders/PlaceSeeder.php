<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Place::create([
            // 'header_image' => 'https://source.unsplash.com/1600x900/?nature,water',
            'header_image' => 'images/body/highlight-image-1.png',
            'name' => 'Pasar Beringharjo',
            'short_description' => 'Pasar Beringharjo adalah pasar tradisional yang terletak di Yogyakarta, Indonesia. Pasar ini merupakan salah satu pasar tertua di Yogyakarta dan menjadi salah satu tempat wisata yang populer di kota ini.',
            'price' => 50000,
            'slug' => 'pasar-beringharjo',
        ]);

        Place::create([
            // 'header_image' => 'https://source.unsplash.com/1600x900/?nature,beach',
            'header_image' => 'images/body/highlight-image-2.png',
            'name' => 'Tanah Lot',
            'short_description' => 'Tanah Lot adalah sebuah pura yang terletak di Bali, Indonesia. Pura ini terletak di atas batu besar di tengah laut dan merupakan salah satu tempat wisata yang populer di Bali.',
            'price' => 100000,
            'slug' => 'tanah-lot',
        ]);

        Place::create([
            // 'header_image' => 'https://source.unsplash.com/1600x900/?nature,mountain',
            'header_image' => 'images/body/highlight-image-3.png',
            'name' => 'Curug Baturaden',
            'short_description' => 'Curug Baturaden adalah sebuah air terjun yang terletak di Purwokerto, Indonesia. Air terjun ini memiliki ketinggian sekitar 50 meter dan merupakan salah satu tempat wisata yang populer di Purwokerto.',
            'price' => 75000,
            'slug' => 'curug-baturaden',
        ]);

        Place::create([
            // 'header_image' => 'https://source.unsplash.com/1600x900/?nature,field',
            'header_image' => 'images/body/highlight-image-4.png',
            'name' => 'Terasering Panyaweuyan',
            'short_description' => 'Terasering Panyaweuyan adalah sebuah sawah terasering yang terletak di Majalengka, Indonesia. Sawah ini memiliki pemandangan yang indah dan merupakan salah satu tempat wisata yang populer di Majalengka.',
            'price' => 1500,
            'slug' => 'terasering-panyaweuyan',
        ]);

        Place::create([
            // 'header_image' => 'https://source.unsplash.com/1600x900/?nature,field',
            'header_image' => 'images/body/highlight-image-5.png',
            'name' => 'Pantai Widuri',
            'short_description' => 'Pantai Widuri adalah sebuah pantai yang terletak di Pemalang, Indonesia. Pantai ini memiliki pemandangan yang indah dan merupakan salah satu tempat wisata yang populer di Pemalang.',
            'price' => 20000,
            'slug' => 'pantai-widuri',
        ]);
    }
}
