<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\ProofPayment;
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
            ProductSeeder::class,
            CustomerSeeder::class,
            ProofPaymentSeeder::class,
        ]);
    }
}
