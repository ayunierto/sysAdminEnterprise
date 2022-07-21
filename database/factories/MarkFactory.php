<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarkFactory extends Factory
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
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(5),
        ];
    }
}
