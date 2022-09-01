<?php

namespace Database\Factories;

use App\Models\Company;
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
        $orders = Order::count();
        $company = Company::count();
        return [
            'companies_id' => rand(1, $company),
            'orders_id' => rand(1, $orders),
            'payment' => rand(1, 5),
            'debt' => rand(1, 5),
            'description' => $this->faker->word(4),
            'state' => rand(0,1),
        ];
    }
}
