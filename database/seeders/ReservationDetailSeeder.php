<?php

namespace Database\Seeders;

use App\Models\ReservationDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReservationDetail::create([
            'reservation_id' => 1,
            'visitor_username' => 'kangmas',
            'place_id' => 1,
            'unit_price' => 100000,
            'quantity' => '1',
        ]);

        ReservationDetail::create([
            'reservation_id' => 2,
            'visitor_username' => 'kangmas',
            'place_id' => 2,
            'unit_price' => 100000,
            'quantity' => '1',
        ]);

        ReservationDetail::create([
            'reservation_id' => 3,
            'visitor_username' => 'kangmas',
            'place_id' => 3,
            'unit_price' => 100000,
            'quantity' => '1',
        ]);

        ReservationDetail::create([
            'reservation_id' => 4,
            'visitor_username' => 'kangmas',
            'place_id' => 4,
            'unit_price' => 100000,
            'quantity' => '1',
        ]);
    }
}
