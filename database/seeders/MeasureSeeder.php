<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Measure;
use Illuminate\Database\Seeder;

class MeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $measures =
        [
            ["code" => "4A",  "name" => "BOBINAS"],
            ["code" => "BJ",  "name" => "BALDE"],
            ["code" => "BLL", "name" => "BARRILES"],
            ["code" => "BG",  "name" => "BOLSA"],
            ["code" => "BO",  "name" => "BOTELLAS"],
            ["code" => "BX",  "name" => "CAJA"],
            ["code" => "CT",  "name" => "CARTONES"],
            ["code" => "CMK", "name" => "CENTIMETRO CUADRADO"],
            ["code" => "CMQ", "name" => "CENTIMETRO CUBICO"],
            ["code" => "CMT", "name" => "CENTIMETRO LINEAL"],
            ["code" => "CEN", "name" => "CIENTO DE UNIDADES"],
            ["code" => "CY",  "name" => "CILINDRO"],
            ["code" => "CJ",  "name" => "CONOS"],
            ["code" => "DZN", "name" => "DOCENA"],
            ["code" => "DZP", "name" => "DOCENA POR 10**6"],
            ["code" => "BE",  "name" => "FARDO"],
            ["code" => "GLI", "name" => "GALON INGLES (4,545956L)"],
            ["code" => "GRM", "name" => "GRAMO"],
            ["code" => "GRO", "name" => "GRUESA"],
            ["code" => "HLT", "name" => "HECTOLITRO"],
            ["code" => "LEF", "name" => "HOJA"],
            ["code" => "SET", "name" => "JUEGO"],
            ["code" => "KGM", "name" => "KILOGRAMO"],
            ["code" => "KTM", "name" => "KILOMETRO"],
            ["code" => "KWH", "name" => "KILOVATIO HORA"],
            ["code" => "KT",  "name" => "KIT"],
            ["code" => "CA",  "name" => "LATAS"],
            ["code" => "LBR", "name" => "LIBRAS"],
            ["code" => "LTR", "name" => "LITRO"],
            ["code" => "MWH", "name" => "MEGAWATT HORA"],
            ["code" => "MTR", "name" => "METRO"],
            ["code" => "MTK", "name" => "METRO CUADRADO"],
            ["code" => "MTQ", "name" => "METRO CUBICO"],
            ["code" => "MGM", "name" => "MILIGRAMOS"],
            ["code" => "MLT", "name" => "MILILITRO"],
            ["code" => "MMT", "name" => "MILIMETRO"],
            ["code" => "MMK", "name" => "MILIMETRO CUADRADO"],
            ["code" => "MMQ", "name" => "MILIMETRO CUBICO"],
            ["code" => "MIL", "name" => "MILLARES"],
            ["code" => "UM", "name" => "MILLON DE UNIDADES"],
            ["code" => "ONZ", "name" => "ONZAS"],
            ["code" => "PF", "name" => "PALETAS"],
            ["code" => "PK", "name" => "PAQUETE"],
            ["code" => "PR", "name" => "PAR"],
            ["code" => "FOT", "name" => "PIES"],
            ["code" => "FTK", "name" => "PIES CUADRADOS"],
            ["code" => "FTQ", "name" => "PIES CUBICOS"],
            ["code" => "C62", "name" => "PIEZAS"],
            ["code" => "PG", "name" => "PLACAS"],
            ["code" => "ST", "name" => "PLIEGO"],
            ["code" => "INH", "name" => "PULGADAS"],
            ["code" => "RM", "name" => "RESMA"],
            ["code" => "DR", "name" => "TAMBOR"],
            ["code" => "STN", "name" => "TONELADA CORTA"],
            ["code" => "LTN", "name" => "TONELADA LARGA"],
            ["code" => "TNE", "name" => "TONELADAS"],
            ["code" => "TU", "name" => "TUBOS"],
            ["code" => "NIU", "name" => "UNIDAD (BIENES)"],
            ["code" => "ZZ", "name" => "UNIDAD (SERVICIOS)"],
            ["code" => "GLL", "name" => "US GALON (3,7843 L)"],
            ["code" => "YRD", "name" => "YARDA"],
            ["code" => "YDK", "name" => "YARDA CUADRADA"],
        ];

        foreach ($measures as $me) {

            Measure::create([
                'code' => $me['code'],
                'name' =>$me['name'],
            ]);

        }
    }
}
