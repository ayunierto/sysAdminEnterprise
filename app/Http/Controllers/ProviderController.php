<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Company;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use Database\Seeders\ProviderSeeder;
use Inertia\Inertia;
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
        return Inertia::render('Providers/Index', [
            'providers' => Provider::all()->map(function ($provider) {
                return [
                    'id' => $provider->id,
                    'company' => Company::find($provider->companies_id)->name,
                    'name' => $provider->name,
                    'document' => $provider->document,
                    'address' => $provider->address,
                    'phone' => $provider->phone,
                    'city' => $provider->city,
                    'state' => $provider->state,
                    'description' => $provider->description,
                ];
            }),
            'companies' => Company::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Providers/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProviderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProviderRequest $request)
    {
        Provider::create([
            'companies_id' => $request->company['id'],
            'name' => $request->name,
            'document' => $request->document,
            'address' => $request->address,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'description' => $request->description,
        ]);
        return Redirect::route('providers.index')->with('message', 'Proveedor agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        //
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
        $provider->update([
            'name' => $request->name,
            'document' => $request->document,
            'address' => $request->address,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'description' => $request->description,
        ]);
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
