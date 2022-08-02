<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2),
            'ruc' => 153698532456,
            'description' => $this->faker->sentence(5),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'department' => $this->faker->country(),
            'province' => $this->faker->country(),
            'district' => $this->faker->country(),
            'country_code' => $this->faker->countryCode(),
            'state' => rand(0,1),
        ];
    }
}
