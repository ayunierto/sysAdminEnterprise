<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Database\Seeders\BatchSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\MeasureSeeder;
use Database\Seeders\PresentationSeeder;
use Database\Seeders\ProviderSeeder;
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
            CompanySeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            MarkSeeder::class,
            MeasureSeeder::class,
            ProviderSeeder::class,
            PresentationSeeder::class,
            BatchSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
