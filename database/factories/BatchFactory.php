<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
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
            'code' => $this->faker->isbn13(),
            'expiration_date' => Now(),
        ];
    }
}
