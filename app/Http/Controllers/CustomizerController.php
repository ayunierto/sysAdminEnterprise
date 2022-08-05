<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomizerRequest;
use App\Http\Requests\UpdateCustomizerRequest;

use App\Models\Customizer;
use App\Models\Company;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CustomizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::user()->companies_id;
        return Inertia::render('Customizers/Index', [
            'customizers' => Customizer::all(),
            'colors' => Customizer::where('companies_id', $company)->get(),
            'companies' => Company::all(),
            'company' => Company::find($company),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomizerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomizerRequest $request)
    {
        Customizer::create($request->all());
        return Redirect::route('customizers.index')->with('message', 'Personalización creada');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomizerRequest  $request
     * @param  \App\Models\Customizer  $customizer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomizerRequest $request, $id)
    {
        $customizer = Customizer::find($id);
        $customizer->update($request->all());
        return Redirect::route('customizers.index')->with('message', 'Personalización actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customizer  $customizer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customizer = Customizer::find($id);
        $customizer->delete();
        return Redirect::route('customizers.index')->with('message', 'Personalización eliminada');
    }
}
