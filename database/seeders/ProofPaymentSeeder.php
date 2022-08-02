<?php

namespace Database\Seeders;

use App\Models\ProofPayment;
use Illuminate\Database\Seeder;

class ProofPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProofPayment::create([
            'code' => '0A1',
            'name' => 'Comprobante', //Para cuando nom quieren emitir Comprovbante electronico
            'serie' => 'CVA1',
        ]);
        ProofPayment::create([
            'code' => '01',
            'name' => 'Factura',
            'serie' => 'FEA1', //adjuntar FEA1- correlativo de 8 digitos
        ]);

        ProofPayment::create([
            'code' => '03',
            'name' => 'Boleta',
            'serie' => 'BEA1', //adjuntar BEA1-correlativo de 8 digitos
        ]);
    }
}
