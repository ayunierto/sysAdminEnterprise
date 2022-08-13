<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountPayableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $purchases=Purchase::count();
        return [
            'purchases_id' => rand(1, $purchases),
            'payment' => rand(1,5),
            'debt' => rand(1,5),
            'description' => $this->faker->word(4),
            'date'=> $this->faker->date(),
        ];
    }
}
