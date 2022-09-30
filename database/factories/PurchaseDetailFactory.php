<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $companies = Company::count();
        $purchases = Purchase::count();
        $products = Product::count();

        return [
            'companies_id' => rand(1, $companies),
            'purchases_id' => rand(1, $purchases),
            'products_id' => rand(1, $products),
            'amount' => rand(1, 4),
            'price' => rand(1, 999),
            'transpote'=> rand(1, 999),
            'igv' => $this->faker->word(1),
            'total' => rand(1, 999),
        ];
    }
}
