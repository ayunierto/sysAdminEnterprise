<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PresentationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $companies = Company::count();
        $products = Product::count();
        
        return [
            'companies_id' => rand(1, $companies),
            // 'products_id' => rand(1, $products),
            'name' => $this->faker->word(),
            'equivalence' => rand(1, 50),
        ];
    }
}
