<?php

namespace Database\Seeders;

use App\Models\Affectation_igv;
use App\Models\Customer;
use App\Models\Customizer;
use App\Models\PaymentMethod;
use App\Models\ProofPayment;
use Database\Seeders\CategorySeeder;
use Database\Seeders\MeasureSeeder;
use Database\Seeders\PresentationSeeder;
use Database\Seeders\ProviderSeeder;
use Faker\Provider\ar_EG\Payment;
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
            ProductSeeder::class,
            PresentationSeeder::class,
            CustomerSeeder::class,
            ProofPaymentSeeder::class,
            CoinSeeder::class,
            PaymentMethodSeeder::class,
            VoucherSeeder::class,
            CustomizerSeeder::class,
            AffectationIgvSeeder::class,
            DocumentSeeder::class,
        ]);
    }
}
