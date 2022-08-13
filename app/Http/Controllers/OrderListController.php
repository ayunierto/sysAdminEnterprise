<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Customizer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProofPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::user()->companies_id;
        return Inertia::render('OrdersList/Index', [
            'orders' => Order::where('companies_id', $company)->get()->map(function ($p) {
                return [
                    'companies_id' => $p->companies_id,
                    'company_name' => Company::find($p->companies_id)->name,
                    'customers_id' => $p->customers_id,
                    'customers_name' => Customer::find($p->customers_id)->name,
                    'payment_methods_id' => $p->payment_methods_id,
                    'payment_method' => PaymentMethod::find($p->payment_methods_id)->description,
                    'proof_payments_id' => $p->proof_payments_id,
                    'proof_payment' => ProofPayment::find($p->proof_payments_id)->name,
                    'coins_id' => $p->coins_id,
                    'coin' => Coin::find($p->coins_id)->code,
                    'documents_id' => $p->documents_id,
                    'documents_name' => Coin::find($p->documents_id)->name,
                    'exchange_rate' => $p->exchange_rate,
                    'total' => $p->total,
                    'date' => $p->date,
                    'state' => $p->state,
                    'state_name' => $p->state == 1 ? 'Registrado' : 'Pendiente',
                    'description' => $p->description,
                    'details' => OrderDetail::where('orders_id', $p->id)->get()->map( function ($d)
                    {
                        return [
                            'id' => $d->id,
                            'orders_id' => $d->purchases_id,
                            'products_id' => $d->products_id,
                            'product_name' => Product::find($d->products_id)->name,
                            'quantity' => $d->quantity,
                            'price' => $d->price,
                            'discount' => $d->discount,
                        ];
                    }),
                ];
            }),
            'company' => Company::find($company),
            'colors' => Customizer::where('companies_id', $company)->get(),
            
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}