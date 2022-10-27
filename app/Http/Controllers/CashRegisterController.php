<?php

namespace App\Http\Controllers;

use App\Models\CashRegister;
use App\Http\Requests\StoreCashRegisterRequest;
use App\Http\Requests\UpdateCashRegisterRequest;
use App\Models\Company;
use App\Models\Customizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CashRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::user()->companies_id;

        return Inertia::render('CashRegisters/Index', [
            'cashRegisters' => CashRegister::where('companies_id', $company_id)->get(),
            'company' => Company::where('id', $company_id)->first(),
            'companies' => Company::all(),
            'colors' => Customizer::where('companies_id', $company_id)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCashRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashRegisterRequest $request)
    {
        CashRegister::create($request->all());
        return Redirect::route('cashRegisters.index')->with('message', 'Caja Agregada');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashRegisterRequest  $request
     * @param  \App\Models\CashRegister  $cashRegister
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashRegisterRequest $request, $id)
    {
        $pettyCash = CashRegister::find($id);
        $pettyCash->update($request->all());
        return Redirect::route('cashRegisters.index')->with('message', 'Datos Actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashRegister  $cashRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pettyCash = CashRegister::find($id);
        $pettyCash->delete();
        return Redirect::route('cashRegisters.index')->with('message', 'Caja eliminada');
    }
}
