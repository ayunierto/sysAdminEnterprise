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
        // User::factory(15)->create();
        // company ALPA
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

        // company ECSMAC
        User::create([
            'name' => 'Master',
            'companies_id' => 2,
            'email' => 'master02@gmail.com',
            'role' => 'master',
            'password' => bcrypt('12345678'),
        ]);

        
        User::create([
            'name' => 'Admin',
            'companies_id' => 2,
            'email' => 'admin02@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Seller',
            'companies_id' => 2,
            'email' => 'seller02@gmail.com',
            'role' => 'seller',
            'password' => bcrypt('12345678'),
        ]);

        // empresa VargasDCP
        User::create([
            'name' => 'Master',
            'companies_id' => 3,
            'email' => 'master03@gmail.com',
            'role' => 'master',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Admin',
            'companies_id' => 3,
            'email' => 'admin03@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Seller',
            'companies_id' => 3,
            'email' => 'seller03@gmail.com',
            'role' => 'seller',
            'password' => bcrypt('12345678'),
        ]);
    }
}
