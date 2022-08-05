<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Company;
use App\Http\Requests\StorePresentationRequest;
use App\Http\Requests\UpdatePresentationRequest;
use App\Models\Product;
use App\Models\Customizer;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class PresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $company = Auth::user()->companies_id;
        return Inertia::render('Presentations/Index', [
            'presentations' => Presentation::where('companies_id', $company)->get()->map(function ($presentation)
            {
                global $company;
                $company = Auth::user()->companies_id;
                return [
                    'id' => $presentation->id,
                    'companies_id' => $presentation->companies_id,
                    'products_id' => $presentation->products_id,
                    'colors' => Customizer::where('companies_id',$company)->get(),
                    'name' => $presentation->name,
                    'equivalence' => $presentation->equivalence,
                    'product' => Product::find($presentation->products_id)->name,
                ];

            }),
            'products' => Product::where('companies_id', $company)->get(),
            'companies' => Company::all(),
            'colors' => Customizer::where('companies_id', $company)->get(),
            'company' => Company::find($company),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePresentationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePresentationRequest $request)
    {
        Presentation::create($request->all());
        return Redirect::route('presentations.index')->with('message', 'Presentación agregada');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePresentationRequest  $request
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePresentationRequest $request,  $id)
    {
        $presentation = Presentation::find($id);
        $presentation->update($request->all());
        return Redirect::route('presentations.index')->with('message', 'Presentación actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presentation = Presentation::find($id);
        $presentation->delete();
        return Redirect::route('presentations.index')->with('message', 'Presentación eliminada');
    }
}
