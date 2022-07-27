<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        if( !Currency::where('symbol','$')->count() )
        {
            Currency::create([
                'name'      => 'Dolar',
                'symbol'    => '$'
            ]);
        }
        if( !Currency::where('symbol','ves')->count() )
        {
            Currency::create([
                'name'      => 'Bolivar',
                'symbol'    => 'ves'
            ]);
        }
    }
}
