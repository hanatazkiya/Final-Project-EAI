<?php

namespace Database\Seeders;

use App\Models\BalanceAccumulations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BalanceAccumulationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BalanceAccumulations::create([
            'username' => 'kangmas',
            'balance' => 1020500
        ]);
    }
}
