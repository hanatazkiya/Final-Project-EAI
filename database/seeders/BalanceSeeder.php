<?php

namespace Database\Seeders;

use App\Models\Balance;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Balance::create([
            'username' => 'kangmas',
            'total_balance' => 1020500
        ]);
    }
}
