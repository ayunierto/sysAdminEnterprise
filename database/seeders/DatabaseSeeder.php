<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            CompanySeeder::class,
            MarkSeeder::class,
        ]);
    }
}
