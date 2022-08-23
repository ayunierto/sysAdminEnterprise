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
use App\Models\OrderDetail;
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
        $company = Auth::user()->companies_id;
        return Inertia::render('Orders/Index', [
            'companies' => Company::all(),
            'customers' => Customer::all(),
            'payment_methods' => PaymentMethod::all(),
            'proof_payments' =>ProofPayment::all(),
            'coins' => Coin::all(),
            'documents' => Document::all(),
            'presentations' => Presentation::all(),
            'affectationIgvs' => AffectationIgv::all(),
            'products' => Product::all(),

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
                    'documents_name' => Document::find($p->documents_id)->name,
                    'voucher_number' => $p->voucher_number,
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
        $query = new SunatController;
        $exchange_rate = $query->exchange_rate()['venta'];
        $company = Auth::user()->companies_id;
        return Inertia::render('Orders/Create', [
            'colors' => Customizer::where('companies_id', $company)->get(),
            'company' => Company::find(Auth::user()->companies_id),
            'proofPayments' => ProofPayment::all(),
            'documents' => Document::all(),
            'customers' => Customer::where('companies_id', $company)->get(),
            'paymentMethods' => PaymentMethod::all(),
            'coins' => Coin::all(),
            'presentations' => Presentation::where('companies_id', $company)->get(),
            'affectationIgvs' => AffectationIgv::all(),
            'exchange_rate' => $exchange_rate,
            'nroComprobantes' => sprintf("%08d", Order::where('companies_id', $company)->where('proof_payments_id',1)->count() + 1),
            'nroFacturas' => sprintf("%08d", Order::where('companies_id', $company)->where('proof_payments_id',2)->count() + 1),
            'nroBoletas' => sprintf("%08d", Order::where('companies_id', $company)->where('proof_payments_id',3)->count() + 1),
            'products' => Product::where('companies_id', $company)->get()->map(function ($p)
            {
                return [
                    'id' => $p->id,
                    'categories_id' => $p->categories_id,
                    'marks_id' => $p->marks_id,
                    'measures_id' => $p->measures_id,
                    'providers_id' => $p->providers_id,
                    'name' => $p->name,
                    'code' => $p->code,
                    'bar_code' => $p->bar_code,
                    'stock' => $p->stock,
                    'purchase_price' => $p->purchase_price,
                    'sale_price' => $p->sale_price,
                    'price_by_unit' => $p->price_by_unit,
                    'wholesale_price' => $p->wholesale_price,
                    'special_price' => $p->special_price,
                    'description' => $p->description,
                    'state' => $p->state,
                    'presentation' => Presentation::where('products_id', $p->id)->first(),
                ];
            }),
        ]);
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
