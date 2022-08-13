<?php

namespace Database\Seeders;

use App\Models\AccountPayable;
use Illuminate\Database\Seeder;

class AccountPayableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountPayable::factory(10)->create();
    }
}
