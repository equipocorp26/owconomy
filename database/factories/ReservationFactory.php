<?php

namespace Database\Factories;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition()
    {
        return [
            'title'   => $this->faker->sentence(3),
            'amount'  => $this->faker->numberBetween(-500,-1),
            'balance_id' => $this->faker->numberBetween( 1 , Balance::count() ),
        ];
    }
}
