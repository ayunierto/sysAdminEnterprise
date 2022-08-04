<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

class CustomizerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'companies_id'=>$this->faker-> unique()->randomElement(['1', '2', '3','4', '5', '6','7', '8', '9','10', '11', '12', '13','14', '15', '16']),
            'primary_color' => $this->faker->colorName(),
            'secondary_color' => $this->faker->colorName(),
            'tertiary_color' => $this->faker->colorName(),
            'logo' => $this->faker->imageUrl(),
        ];
    }
}
