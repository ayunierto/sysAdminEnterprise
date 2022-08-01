<?php

namespace Database\Factories;

use App\Models\Company;
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
        $amount = Company::count();
        return [
            'companies_id' => rand(1, $amount),
            'products_id' => rand(1, 100),
            'name' => $this->faker->word(),
            'equivalence' => $this->faker->randomElement($array = array ('1k','10k','5k')),
        ];
    }
}
