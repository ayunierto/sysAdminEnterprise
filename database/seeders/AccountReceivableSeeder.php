<?php

namespace Database\Seeders;

use App\Models\AccountReceivable;
use Illuminate\Database\Seeder;

class AccountReceivableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountReceivable::factory(10)->create();
    }
}
