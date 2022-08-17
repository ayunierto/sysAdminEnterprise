<?php

namespace Database\Factories;

use App\Models\Coin;
use App\Models\Company;
use App\Models\PaymentMethod;
use App\Models\ProofPayment;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $companies = Company::count();
        $providers = Provider::count();
        $payment_methods = PaymentMethod::count();
        $proof_payments = ProofPayment::count();
        $coins = Coin::count();

        return [
            'companies_id' => rand(1, $companies),
            'providers_id' => rand(1, $providers),
            'payment_methods_id' => rand(1, $payment_methods),
            'proof_payments_id' => rand(1, $proof_payments),
            'coins_id' => rand(1, $coins),
            'voucher_number' => 'C032-007852',
            'exchange_rate' => 3.9,
            'total' => rand(1, 999),
            'date'=> $this->faker->date(),
            'state' => rand(0,1),
            'description' => $this->faker->sentence(5)

        ];
    }
}
