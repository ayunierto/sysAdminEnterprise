<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\AccountPayable;
use App\Models\Coin;
use App\Models\Company;
use App\Models\Customizer;
use App\Models\Document;
use App\Models\Mark;
use App\Models\PaymentMethod;
use App\Models\Presentation;
use App\Models\Product;
use App\Models\ProofPayment;
use App\Models\Provider;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $company = Auth::user()->companies_id;

        return Inertia::render('Purchases/Index', [
            'companies' => Company::all(),
            'providers' => Provider::where('companies_id', $company)->get(),
            'payment_methods' => PaymentMethod::all(),
            'proof_payments' => ProofPayment::all(),
            'coins' => Coin::all(),
            'purchases' => Purchase::where('companies_id', $company)->get()->map(function ($p) {
                return [
                    'id' => $p->id,
                    'companies_id' => $p->companies_id,
                    'company_name' => Company::find($p->companies_id)->name,
                    'providers_id' => $p->providers_id,
                    'provider_name' => Provider::find($p->providers_id)->name,
                    'payment_methods_id' => $p->payment_methods_id,
                    'payment_method' => PaymentMethod::find($p->payment_methods_id)->description,
                    'proof_payments_id' => $p->proof_payments_id,
                    'proof_payment' => ProofPayment::find($p->proof_payments_id)->name,
                    'coins_id' => $p->coins_id,
                    'coin' => Coin::find($p->coins_id)->code,
                    'voucher_number' => $p->voucher_number,
                    'total' => $p->total,
                    'date' => $p->date,
                    'state' => $p->state,
                    'exchange_rate' => $p->exchange_rate,
                    'state_name' => $p->state == 1 ? 'Registrado' : 'Pendiente',
                    'description' => $p->description,
                    'details' => PurchaseDetail::where('purchases_id', $p->id)->get()->map(function ($d) {
                        return [
                            'id' => $d->id,
                            'companies_id' => $d->companies_id,
                            'purchases_id' => $d->purchases_id,
                            'products_id' => $d->products_id,
                            'product_name' => Product::find($d->products_id)->name,
                            'amount' => $d->amount,
                            'price' => $d->price,
                            'transporte' => $d->transporte,
                            'igv' => $d->igv,
                            'subTotal' => $d->total,
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
        if ($query->exchange_rate() == 'error') {
            $exchange_rate = 0;
        } else {
            $exchange_rate = $query->exchange_rate()['compra'];
        }

        $company = Auth::user()->companies_id;
        return Inertia::render('Purchases/Create', [
            'company' => Company::find($company),
            'colors' => Customizer::where('companies_id', $company)->get(),
            'companies' => Company::all(),
            'providers' => Provider::where('companies_id', $company)->get(),
            'payment_methods' => PaymentMethod::all(),
            'proof_payments' => ProofPayment::all(),
            'presentations' => Presentation::where('companies_id', $company)->get(),
            'coins' => Coin::all(),
            'exchange_rate' => $exchange_rate,
            'documents' => Document::all(),
            'products' => Product::where('companies_id', $company)->get()->map(function ($p) {
                return [
                    'id' => $p->id,
                    'categories_id' => $p->categories_id,
                    'marks_id' => $p->marks_id,
                    'marks_name' => Mark::find($p->marks_id)->name,
                    'measures_id' => $p->measures_id,
                    'providers_id' => $p->providers_id,
                    'name' => $p->name,
                    'type' => $p->type,
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
                    // 'presentation' => Presentation::where('products_id', $p->id)->first(),
                ];
            }),

        ]);
    }

    /**
     * 
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        $purchase = new Purchase();

        $purchase->companies_id = $request->companies_id;
        $purchase->providers_id = $request->providers_id;
        $purchase->payment_methods_id = $request->paymentMethods_id;
        $purchase->proof_payments_id = $request->proofPayments_id;
        $purchase->coins_id = $request->coins_id;
        $purchase->voucher_number = $request->voucher_number;
        $purchase->exchange_rate = $request->exchange_rate;
        $purchase->total = $request->total;
        $purchase->date = $request->date;
        if ($request->totalPago < $request->total) {
            $purchase->state = 0;
        }
        $purchase->description = $request->description;

        $purchase->save();


        $products = $request->products;

        foreach ($products as $key => $value) {
            $purchase_details = new PurchaseDetail();

            $purchase_details->companies_id         = $request->companies_id;
            $purchase_details->purchases_id         = $purchase->id;
            $purchase_details->products_id          = $value['productId'];
            $purchase_details->amount               = $value['amount'];
            $purchase_details->price                = $value['purchase_price'];
            $purchase_details->transporte           = $value['transporte'];
            $purchase_details->igv                  = $value['igv'];
            $purchase_details->total                = $value['subTotal'];

            $purchase_details->save();

            // Actualizar el stock
            $dtsProducto = Product::find($value['productId']);
            $cant = $value['amount'] * $value['equivalence'];
            if ($value['type'] == 'Producto') {
                $dtsProducto->update([
                    $dtsProducto->stock += $cant,
                    $dtsProducto->purchase_price= $value['purchase_price'],
                    $dtsProducto->sale_price = $value['sale_price'],
                ]);
            }
            // Registra cuentas por Pagar
            if ($request->totalPago < $request->total) {
                $accountReceivable = new AccountPayable();
                $accountReceivable->companies_id = $request->companies_id;
                $accountReceivable->purchases_id = $purchase->id;
                $accountReceivable->payment = $request->totalPago;
                $accountReceivable->debt = $request->total - $request->totalPago;
                $accountReceivable->save();
            }
        }


        return Redirect::route('purchases.index')->with('message', 'Compra agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, $id)
    {
        // $purchase = Purchase::find($id);
        // $purchase->update([
        //     $purchase->date = $request->date,   
        //     $purchase->state = $request->state, 
        // ]);
        // return Redirect::route('purchases.index')->with('message', 'Compra actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id)->delete();
        return Redirect::route('purchases.index')->with('message', 'Compra eliminada');
    }
}
