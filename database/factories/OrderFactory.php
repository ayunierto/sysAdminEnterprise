<?php

namespace Database\Factories;

use App\Models\Coin;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Document;
use App\Models\PaymentMethod;
use App\Models\ProofPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $companies = Company::count();
        $customers = Customer::count();
        $payment_methods = PaymentMethod::count();
        $proof_payments = ProofPayment::count();
        $coins = Coin::count();
        $documents = Document::count();

        return [
            'companies_id' => rand(1, $companies),
            'customers_id' => rand(1, $customers),
            'payment_methods_id' => rand(1, $payment_methods),
            'proof_payments_id' => rand(1, $proof_payments),
            'coins_id' => rand(1, $coins),            
            'documents_id' => rand(1, $documents),
            'exchange_rate' => 3.9,
            'total' => rand(1, 999),
            'date'=> $this->faker->date(),
            'state' => rand(0,1),
            'description' => $this->faker->sentence(5)
        ];
    }
}
