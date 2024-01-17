<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'name' => 'U.S. Dollar',
            'code' => 'USD',
            'symbol' => '$',
            'format' => '$1,0.00',
            'exchange_rate' => 1.00000000,
            'active' => 1,
        ]);
        Currency::create([
            'name' => 'Euro',
            'code' => 'EUR',
            'symbol' => ' €',
            'format' => ' €1,0.00',
            'exchange_rate' => 1.00000000,
            'active' => 1,
        ]);
    }
}
