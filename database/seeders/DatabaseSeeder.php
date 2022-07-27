<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory(20)->create();
        $this->call(CurrencySeeder::class);
        \App\Models\Balance::factory(40)->create();
        \App\Models\Movement::factory(80)->create();
        $this->call(BalanceSeeder::class);
        \App\Models\Reservation::factory(40)->create();
    }
}
