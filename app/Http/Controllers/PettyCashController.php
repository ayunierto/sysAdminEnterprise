<?php

namespace App\Http\Controllers;

use App\Models\PettyCash;
use App\Http\Requests\StorePettyCashRequest;
use App\Http\Requests\UpdatePettyCashRequest;
use App\Models\Coin;
use App\Models\Company;
use App\Models\Customizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PettyCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::user()->companies_id;

        return Inertia::render('PettyCashes/Index', [
            'pettyCashes' => PettyCash::where('companies_id', $company_id)->get(),
            'company' => Company::where('id', $company_id)->first(),
            'companies' => Company::all(),
            'colors' => Customizer::where('companies_id', $company_id)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePettyCashRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePettyCashRequest $request)
    {
        PettyCash::create($request->all());
        return Redirect::route('pettyCashes.index')->with('message', 'Caja Agregada');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePettyCashRequest  $request
     * @param  \App\Models\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePettyCashRequest $request, $id)
    {
        $pettyCash = PettyCash::find($id);
        $pettyCash->update($request->all());
        return Redirect::route('pettyCashes.index')->with('message', 'Datos Actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pettyCash = PettyCash::find($id);
        $pettyCash->delete();
        return Redirect::route('pettyCashes.index')->with('message', 'Caja eliminada');
    }
}
