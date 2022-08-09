<?php

namespace Database\Seeders;

use App\Models\PurchaseDetail;
use Illuminate\Database\Seeder;

class PurchaseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurchaseDetail::factory(50)->create();
    }
}
