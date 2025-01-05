<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\PlaceSeeder;
use Database\Seeders\RefundSeeder;
use Database\Seeders\BalanceSeeder;
use Database\Seeders\PlaceDetailSeeder;
use Database\Seeders\PlaceImagesSeeder;
use Database\Seeders\ReservationSeeder;
use Database\Seeders\PlaceFeaturesSeeder;
use Database\Seeders\ReservationDetailSeeder;
use Database\Seeders\BalanceAccumulationsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'kangmas',
            'name' => 'Davis Arrizqi Putra Mandiri',
            'email' => 'kangmas@nusanio.com',
        ]);

        $this->call([
            // data master
            AdminSeeder::class,
            PlaceSeeder::class,
            // ReservationSeeder::class,

            // data transaksional
            BalanceAccumulationsSeeder::class,
            BalanceSeeder::class,
            PlaceDetailSeeder::class,
            PlaceFeaturesSeeder::class,
            PlaceUniquenessSeeder::class,
            PlaceImagesSeeder::class,
            // RefundSeeder::class,
            // ReservationDetailSeeder::class,
        ]);
    }
}
