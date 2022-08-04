<?php

namespace Database\Seeders;

use App\Models\Customizer;
use Illuminate\Database\Seeder;

class CustomizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customizer::factory(16)->create();
    }
}
