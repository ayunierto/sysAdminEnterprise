<?php

namespace Database\Factories;

use App\Models\Company;
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
            // 'companies_id' => $this->faker-> unique()->randomElement(['1', '2', '3','4', '5', '6','7', '8', '9','10', '11', '12', '13','14', '15', '16']),
            // 'color_menu' => $this->faker->hexColor(),
            // 'color_header' => $this->faker->hexColor(),
            // 'color_footer' => $this->faker->hexColor(),
            // 'color_text' => $this->faker->hexColor(),
            // 'logo' => $this->faker->imageUrl(),
        ];
    }
}
