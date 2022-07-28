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
        User::factory(15)->create();
        User::create([
            'name' => 'Alcides Yunier Turruellas Osorio',
            'email' => 'ayunierto@gmail.com',
            'password' => bcrypt('maskmask'),
        ]);
        User::create([
            'name' => 'Ronal',
            'email' => 'ronal@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Jhon',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('secret'),
        ]);

    }
}
