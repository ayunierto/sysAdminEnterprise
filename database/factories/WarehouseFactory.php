<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
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
            'name' => $this->faker->name(),
            'contact_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'description' => $this->faker->sentence(6),
            'state' => rand(0, 1),
        ];
    }
}
