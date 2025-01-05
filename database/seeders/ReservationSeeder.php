<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservation = new Reservation();

        Reservation::create([
            'booking_for' => '2024-12-25',
            'status' => '0',
            'reservation_invoice' => $reservation->generateInvoiceNumber(),
        ]);

        Reservation::create([
            'booking_for' => '2024-12-25',
            'status' => '0',
            'reservation_invoice' => $reservation->generateInvoiceNumber(),
        ]);

        Reservation::create([
            'booking_for' => '2024-12-25',
            'status' => '0',
            'reservation_invoice' => $reservation->generateInvoiceNumber(),
        ]);

        Reservation::create([
            'booking_for' => '2024-12-25',
            'status' => '0',
            'reservation_invoice' => $reservation->generateInvoiceNumber(),
        ]);
    }
}
