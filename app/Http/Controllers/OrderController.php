<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customizer;
use App\Models\Company;
use App\Models\ProofPayment;
use App\Models\Document;
use App\Models\Customer;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\AffectationIgv;
use App\Models\Coin;
use App\Models\PaymentMethod;
use App\Models\Presentation;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = new SunatController;
        $exchange_rate = $query->exchange_rate()['venta'];
        $company = Auth::user()->companies_id;
        return Inertia::render('Orders/Index', [
            'colors' => Customizer::where('companies_id', $company)->get(),
            'company' => Company::find(Auth::user()->companies_id),
            'proofPayments' => ProofPayment::all(),
            'documents' => Document::all(),
            'customers' => Customer::all(),
            'paymentMethods' => PaymentMethod::all(),
            'coins' => Coin::all(),
            'presentations' => Presentation::all(),
            'affectationIgvs' => AffectationIgv::all(),
            'products' => Product::all(),
            'exchange_rate' => $exchange_rate,
            'orders' => sprintf("%08d", Order::where('companies_id', $company)->count() + 1),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
