<?php

namespace Database\Seeders;

use App\Models\Refund;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Refund::create([
            'username' => 'kangmas',
            'reservation_id' => 3,
            'status' => '0',
        ]);
    }
}
