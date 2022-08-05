<?php

namespace App\Http\Controllers;

use App\Models\ProofPayment;
use App\Http\Requests\StoreProofPaymentRequest;
use App\Http\Requests\UpdateProofPaymentRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Customizer;
use Illuminate\Support\Facades\Redirect;

class ProofPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('ProofPayments/Index', [
            'proofPayments' => ProofPayment::all(),
            'company' => Company::find(Auth::user()->companies_id),
            'colors' => Customizer::where('companies_id', $company)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProofPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProofPaymentRequest $request)
    {
        ProofPayment::create($request->all());
        return Redirect::route('proofPayments.index')->with('message', 'Comprobante agregado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProofPaymentRequest  $request
     * @param  \App\Models\ProofPayment  $proofPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProofPaymentRequest $request, $id)
    {
        $proofPayment = ProofPayment::find($id);
        $proofPayment->update($request->all());
        return Redirect::route('proofPayments.index')->with('message', 'Comprobante actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProofPayment  $proofPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proofPayment = ProofPayment::find($id);
        $proofPayment->delete();
        return Redirect::route('proofPayments.index')->with('message', 'Comprobante eliminada');
    }
}
