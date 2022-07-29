<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)->create();
        User::create([
            'name' => 'Alcides Yunier Turruellas Osorio',
            'companies_id' => 1,
            'email' => 'ayunierto@gmail.com',
            'password' => bcrypt('maskmask'),
            'role' => 'master',
        ]);
        User::create([
            'name' => 'Ronal',
            'companies_id' => 1,
            'email' => 'ronal@gmail.com',
            'role' => 'master',
            'password' => bcrypt('12345678'),
        ]);
    }
}
