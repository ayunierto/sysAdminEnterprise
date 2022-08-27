<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountReceivableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $orders=Order::count();
        return [
            'orders_id' => rand(1, $orders),
            'payment' => rand(1,5),
            'debt' => rand(1,5),
            'description' => $this->faker->word(4),
        ];
    }
}
