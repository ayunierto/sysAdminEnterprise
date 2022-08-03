<?php

namespace Database\Seeders;

use App\Models\Coin;
use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coin::create([
            'code' => 'PEN',
            'description' => 'Descripcion'
        ]);

        Coin::create([
            'code' => 'USD',
            'description' => 'Descripcion'
        ]);
    }
}
