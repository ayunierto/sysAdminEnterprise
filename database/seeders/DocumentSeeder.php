<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::create([
            'code' => '01',
            'name' => 'DNI',
            'description' => 'Documento Nacional de Identidad',
            'state' => 1
        ]);

        Document::create([
            'code' => '06',
            'name' => 'RUC',
            'description' => 'Régimen Único de Contribuyentes',
            'state' => 1
        ]);
    }
}
