<?php

namespace Database\Seeders;

use App\Models\AffectationIgv;
use Illuminate\Database\Seeder;

class AffectationIgvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $affectation =
            [
                ["code" => "10",  "description" => "Gravado - Operación Onerosa"],
                ["code" => "11",  "description" => "Gravado - Retiro por premio"],
                ["code" => "12", "description" => "Gravado - Retiro por donación"],
                ["code" => "13",  "description" => "Gravado - Retiro"],
                ["code" => "14",  "description" => "Gravado - Retiro por publicidad"],
                ["code" => "15",  "description" => "Gravado - Bonificaciones"],
                ["code" => "16",  "description" => "Gravado - Retiro por entrega a trabajadores"],
                ["code" => "17", "description" => "Gravado - IVAP"],
                ["code" => "20", "description" => "Exonerado - Operación Onerosa"],
                ["code" => "21", "description" => "Exonerado - Transferencia Gratuita"],
                ["code" => "30", "description" => "Inafecto - Operación Onerosa"],
                ["code" => "31",  "description" => "Inafecto - Retiro por Bonificación"],
                ["code" => "32",  "description" => "Inafecto - Retiro"],
                ["code" => "33", "description" => "Inafecto - Retiro por Muestras Médicas"],
                ["code" => "34", "description" => "Inafecto - Retiro por Convenio Colectivo"],
                ["code" => "35",  "description" => "Inafecto - Retiro por premio"],
                ["code" => "36", "description" => "Inafecto - Retiro por publicidad"],
                ["code" => "40", "description" => "Exportación de bienes o servicios"],
            ];

        foreach ($affectation as $me) {

            AffectationIgv::create([
                'code' => $me['code'],
                'description' => $me['description'],
            ]);
        }
    }
}
