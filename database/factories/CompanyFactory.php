<?php

namespace Database\Factories;

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
            'ruc' => $this->faker->phoneNumber(),
            'description' => $this->faker->sentence(5),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'department' => $this->faker->country(),
            'province' => $this->faker->country(),
            'district' => $this->faker->country(),
            'country_code' => $this->faker->countryCode(),
            'state' => $this->faker->country(),
        ];
    }
}
