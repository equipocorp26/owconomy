<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory(5)->create();
        $this->call(CurrencySeeder::class);
        \App\Models\Balance::factory(10)->create();
        \App\Models\Movement::factory(200)->create();
        $this->call(BalanceSeeder::class);
        \App\Models\Reservation::factory(40)->create();
    }
}
