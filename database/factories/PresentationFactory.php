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
        $companies = Company::count();
        
        return [
            'companies_id' => rand(1, $companies),
            'name' => $this->faker->word(1),
            'equivalence' => $this->faker->randomElement($array = array ('1k','2k','10k','5k')),
        ];
    }
}
