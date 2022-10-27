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
        Customizer::create([
            'companies_id' => '1',
            'color_menu' => '#1350B3',
            'color_sub_menu' => '#25586B',
            'color_header' => '#195497',
            'color_footer' => '#195497',
            'color_text' => '#FFFCF9',
            'logo' => 'img/empresa/logo_empresa.png',
        ]);
        // Customizer::factory(16)->create();
    }
}
