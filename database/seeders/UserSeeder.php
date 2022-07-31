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

        User::create([
            'name' => 'Master',
            'companies_id' => 1,
            'email' => 'master@gmail.com',
            'role' => 'master',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Admin',
            'companies_id' => 1,
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Seller',
            'companies_id' => 1,
            'email' => 'seller@gmail.com',
            'role' => 'seller',
            'password' => bcrypt('12345678'),
        ]);
    }
}
