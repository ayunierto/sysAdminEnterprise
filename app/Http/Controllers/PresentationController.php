<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Company;
use App\Http\Requests\StorePresentationRequest;
use App\Http\Requests\UpdatePresentationRequest;
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
            'presentations' => Presentation::where('companies_id', $company)->get(),
            'companies' => Company::all(),
            'company' => Company::find($company),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return Inertia::render('Presentations/Create');
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
