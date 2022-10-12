<?php

namespace App\Http\Controllers;

use App\Models\AccountPayable;
use App\Http\Requests\StoreAccountPayableRequest;
use App\Http\Requests\UpdateAccountPayableRequest;
use App\Models\Coin;
use App\Models\Company;
use App\Models\Customizer;
use App\Models\PettyCash;
use App\Models\Product;
use App\Models\ProofPayment;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AccountPayableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::user()->companies_id;
        return Inertia::render('AccountPayables/Index', [
            'accountPayables' => AccountPayable::where('companies_id', $company)->where('state', 0)->get()->map(function ($p) {
                return [
                    'id' => $p->id,
                    'purchases_id' => $p->purchases_id,
                    $id_proveedor = Purchase::where('id', $p->purchases_id)->value('providers_id'),
                    'provider_name' => Provider::find($id_proveedor)->name,
                    $id_comprobante = Purchase::where('id', $p->purchases_id)->value('proof_payments_id'),
                    'proof_payments_name' => ProofPayment::find($id_comprobante)->name,
                    $id_moneda = Purchase::where('id', $p->purchases_id)->value('coins_id'),
                    'coin' => Coin::find($id_moneda)->code,
                    'exchange_rate' => Purchase::where('id', $p->purchases_id)->value('exchange_rate'),
                    'total' => Purchase::where('id', $p->purchases_id)->value('total'),
                    'date' => Purchase::where('id', $p->purchases_id)->value('date'),
                    'payment' => $p->payment,
                    'debt'  => $p->debt,
                    'description' => $p->description,
                    'details' => PurchaseDetail::where('purchases_id', $p->purchases_id)->get()->map(function ($d) {
                        return [
                            'id' => $d->id,
                            'purchases_id' => $d->purchases_id,
                            'products_id' => $d->products_id,
                            'product_name' => Product::find($d->products_id)->name,
                            'amount' => $d->amount,
                            'price' => $d->price,
                            'total' => $d->total,
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
     * @param  \App\Http\Requests\StoreAccountPayableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountPayableRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountPayable  $accountPayable
     * @return \Illuminate\Http\Response
     */
    public function show(AccountPayable $accountPayable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountPayable  $accountPayable
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountPayable $accountPayable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountPayableRequest  $request
     * @param  \App\Models\AccountPayable  $accountPayable
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountPayableRequest $request, $id)
    {
        $company = Auth::user()->companies_id;
        $accountPayable = AccountPayable::find($id);
        $id_purchase = AccountPayable::where('id', $id)->value('purchases_id');
        $purchases = Purchase::find($id_purchase);
        $nvPago = $request->payment + $request->totalPago;
        $nvDeuda = $request->debt - $request->totalPago;
        if ($nvDeuda == 0) {
            $nvestado = 1;
        } else {
            $nvestado = 0;
        };
        $accountPayable->update([
            'payment' => $nvPago,
            'debt' => $nvDeuda,
            'description' => $request->description,
            'state' => $nvestado,
        ]);
        $purchases->update([
            'state' => $nvestado,
        ]);

        $pettyCash = PettyCash::where('companies_id', $company)->where('state', 1)->get();
        if ($purchases->coins_id == 1) {
            $pettyCash[0]->update([
                $pettyCash[0]->amount_pen -= $request->totalPago,
            ]);
        } else {
            if ($purchases->coins_id == 2) {
                $pettyCash[0]->update([
                    $pettyCash[0]->amount_usd -= $request->totalPago,
                ]);
            }
        }
        return Redirect::route('accountPayables.index')->with('message', 'Pago realizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountPayable  $accountPayable
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountPayable $accountPayable)
    {
        //
    }
}
