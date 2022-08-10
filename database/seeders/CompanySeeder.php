<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'ALPA PERU',
            'ruc' => '0000000000',
            'description' => 'ALPA PERU',
            'phone' => '999999999',
            'address' => 'Cajamarca, Cajamarca, Cajamarca',
            'department' => 'Cajamarca',
            'province' => 'Cajamarca',
            'district' => 'Cajamarca',
            'country_code' => '06001',
            'state' => 1,
        ]);
        Company::create([
            'name' => 'ECSMAC EIRL',
            'ruc' => '0000000001',
            'description' => 'CONTRUYENDO FUTUROS',
            'phone' => '999999990',
            'address' => 'Cajamarca, Cajamarca, Cajamarca',
            'department' => 'Cajamarca',
            'province' => 'Cajamarca',
            'district' => 'Cajamarca',
            'country_code' => '06001',
            'state' => 1,
        ]);
        Company::create([
            'name' => 'VargasDCP SRL',
            'ruc' => '0000000000',
            'description' => 'SOLO CALIDAD',
            'phone' => '999999998',
            'address' => 'Cajamarca, Cajamarca, Cajamarca',
            'department' => 'Cajamarca',
            'province' => 'Cajamarca',
            'district' => 'Cajamarca',
            'country_code' => '06001',
            'state' => 1,
        ]);

        Company::factory(2)->create();
    }
}
