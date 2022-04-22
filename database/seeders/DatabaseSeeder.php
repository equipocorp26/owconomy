<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory(20)->create();
        \App\Models\Balance::factory(30)->create();
        \App\Models\Movement::factory(40)->create();
        \App\Models\Reservation::factory(20)->create();
    }
}
