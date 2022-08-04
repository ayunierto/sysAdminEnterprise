<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Company;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Customizer;
use Illuminate\Support\Facades\Redirect;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::user()->companies_id;
        return Inertia::render('Providers/Index', [
            'providers' => Provider::where('companies_id', $company)->get(),
            'companies' => Company::all(),
            'company' => Company::find($company),
            'perzonalizer' => Customizer::find(Auth::user()->companies_id),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProviderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProviderRequest $request)
    {
        Provider::create($request->all());
        return Redirect::route('providers.index')->with('message', 'Proveedor agregado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProviderRequest  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProviderRequest $request, $id)
    {
        $provider = Provider::find($id);
        $provider->update($request->all());
        return Redirect::route('providers.index')->with('message', 'Proveedor actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $provider->delete();
        return Redirect::route('providers.index')->with('message', 'Proveedor eliminado');
    }
}
