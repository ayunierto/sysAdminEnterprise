<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Company;
use App\Models\Mark;
use App\Models\Measure;
use App\Models\Presentation;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $companies = Company::count();
        $categories = Category::count();
        $marks = Mark::count();
        $measures = Measure::count();
        $providers = Provider::count();

        return [
            'companies_id' => rand(1, $companies),
            'categories_id' => rand(1, $categories),
            'marks_id' => rand(1, $marks),
            'measures_id' => rand(1, $measures),
            'providers_id' => rand(1, $providers),
            'name' =>$this->faker->word(1),
            'code' =>$this->faker->isbn10(),
            'bar_code' =>$this->faker->isbn13(),
            'stock' => rand(1, 999),
            'purchase_price' => rand(1,100),
            'sale_price' => rand(1,100),
            'price_by_unit' => rand(1,100),
            'wholesale_price' => rand(1,100),
            'special_price' => rand(1,100),
            'description' => $this->faker->sentence(6),
            'state' => rand(0,1),
            'expiration_date' => now(),
        ];
    }
}
