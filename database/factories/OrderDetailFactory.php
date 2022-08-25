<?php

namespace Database\Factories;

use App\Models\AffectationIgv;
use App\Models\Company;
use App\Models\Order;
use App\Models\Presentation;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $orders = Order::count();
        $products = Product::count();
        $aff_igvs=AffectationIgv::count();
        $presentations=Presentation::count();

        return [
            'orders_id' => rand(1, $orders),
            'products_id' => rand(1, $products),
            'affectation_igvs_id' => rand(1, $aff_igvs),
            'presentations_id'=> rand(1, $presentations),
            'quantity' => rand(1, 4),
            'price' => rand(10, 999),
            'discount' => rand(1, 7),
            'igv'=> rand(1, 7),
            'subTotal' => rand(1, 999),
        ];
    }
}
