<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Company;
use App\Models\Product;
use App\Http\Requests\StorePresentationRequest;
use App\Http\Requests\UpdatePresentationRequest;
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
        return Inertia::render('Presentations/Index', [
            'presentations' => Presentation::all()->map(function ($presentation) {
                return [
                    'id' => $presentation->id,
                    'company' => Company::find($presentation->companies_id)->name,
                    'product' => Product::find($presentation->products_id)->name,
                    'name' => $presentation->name,
                    'equivalence' => $presentation->equivalence,
                ];
            }),
            'companies' => Company::all(),
            'products' => Product::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Presentations/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePresentationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePresentationRequest $request)
    {

        Presentation::create([
            'companies_id' => $request->company['id'],
            'products_id' => $request->product['id'],
            'name' => $request->name,
            'equivalence' => $request->equivalence,
        ]);
        return Redirect::route('presentations.index')->with('message', 'Presentación agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function show(Presentation $presentation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function edit(Presentation $presentation)
    {
        //
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
        $presentation->update([
            'name' => $request->name,
            'equivalence' => $request->equivalence,
        ]);
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
