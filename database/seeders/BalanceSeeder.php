<?php

namespace Database\Seeders;

use App\Models\Balance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BalanceSeeder extends Seeder
{
    public function run()
    {
        foreach (Balance::all() as $key => $balance) {
            $balance->update([
                'amount' => $balance->movements()->where('amount','>',0)->sum('amount') + $balance->movements()->where('amount','<',0)->sum('amount')
            ]);
        }
    }
}
