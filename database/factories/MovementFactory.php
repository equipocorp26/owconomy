<?php

namespace Database\Factories;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovementFactory extends Factory
{
    public function definition()
    {
        return [
            'title'      => $this->faker->sentence(3),
            'reference'  => $this->faker->numberBetween(1000000,9999999),
            'date'       => date('Y-m-d'),
            'amount'     => $this->faker->numberBetween(-1000,1000),
            'balance_id' => $this->faker->numberBetween( 1 , Balance::count() ),
            'detail'     => $this->faker->boolean() ? $this->faker->sentence(4) : null,
        ];
    }
}
