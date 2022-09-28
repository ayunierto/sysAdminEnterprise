<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Coin;
use App\Models\Company;
use App\Models\Customizer;
use App\Models\Document;
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
            'proof_payments' =>ProofPayment::all(),
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
                    'details' => PurchaseDetail::where('purchases_id', $p->id)->get()->map( function ($d)
                    {
                        return [
                            'id' => $d->id,
                            'companies_id' => $d->companies_id,
                            'purchases_id' => $d->purchases_id,
                            'products_id' => $d->products_id,
                            'product_name' => Product::find($d->products_id)->name,
                            'amount' => $d->amount,
                            'price' => $d->price,
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
        // $query = new SunatController;
        // dd($query->exchange_rate()); 
        // $exchange_rate = $query->exchange_rate['compra'];
        $exchange_rate = 3.85;

        $company = Auth::user()->companies_id;
        return Inertia::render('Purchases/Create', [
            'company' => Company::find($company),
            'colors' => Customizer::where('companies_id', $company)->get(),
            'companies' => Company::all(),
            'providers' => Provider::where('companies_id', $company)->get(),
            'payment_methods' => PaymentMethod::all(),
            'proof_payments' =>ProofPayment::all(),
            'presentations' => Presentation::where('companies_id', $company)->get(),
            'coins' => Coin::all(),
            'exchange_rate' => $exchange_rate,
            'documents' => Document::all(),
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
        $company = Auth::user()->companies_id;

        $purchase = new Purchase();

        $purchase->companies_id = $request->companies_id;   
        $purchase->providers_id = $request->providers_id;   
        $purchase->payment_methods_id = $request->payment_methods_id;   
        $purchase->proof_payments_id = $request->proof_payments_id; 
        $purchase->coins_id = $request->coins_id;   
        $purchase->voucher_number = $request->voucher_number;   
        $purchase->exchange_rate = $request->exchange_rate; 
        $purchase->total = $request->total; 
        $purchase->date = $request->date;   
        $purchase->state = $request->state; 
        
        $purchase->save();   
        
        
        $products = $request->products;  
        
        foreach ($products as $key => $value) {
            $purchase_details = new PurchaseDetail();

            $purchase_details->companies_id         = $request->companies_id; 
            $purchase_details->purchases_id         = $purchase->id; 
            $purchase_details->products_id          = $value['id'];
            $purchase_details->amount               = $value['amount'];
            $purchase_details->price                = $value['purchase_price'];
            $purchase_details->total                = $value['total'];

            $purchase_details->save();
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
        $purchase = Purchase::find($id);
        $purchase->update([
            $purchase->date = $request->date,   
            $purchase->state = $request->state, 
        ]);
        return Redirect::route('purchases.index')->with('message', 'Compra actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $purchase = Purchase::find($id)->delete();
        return Redirect::route('purchases.index')->with('message', 'Compra eliminada');
    }
}
