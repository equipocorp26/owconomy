<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BalanceFactory extends Factory
{
    public function definition()
    {
        return [
            'title'   => $this->faker->sentence(3),
            'amount'  => $this->faker->numberBetween(0,1000),
            'user_id' => $this->faker->numberBetween( 1 , User::count() ),
        ];
    }
}
