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

        // Company::factory(5)->create();

    }
}
