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
            'logo' => '/img/logo_user.png',
        ]);
        Customizer::create([
            'companies_id' => '2',
            'color_menu' => '#014ba0',
            'color_sub_menu' => '#1E88E5',
            'color_header' => '#014ba0',
            'color_footer' => '#014ba0',
            'color_text' => '#FFFFFFFF',
            'logo' => '/img/logo_user.png',
        ]);
        Customizer::create([
            'companies_id' => '3',
            'color_menu' => '#F48633',
            'color_sub_menu' => '#0179BF',
            'color_header' => '#F48633',
            'color_footer' => '#F48633',
            'color_text' => '#FEFEFE',
            'logo' => '/img/logo_user.png',
        ]);
        // Customizer::factory(16)->create();
    }
}
