<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Company;
use App\Models\Customizer;
use App\Http\Requests\StoreMarkRequest;
use App\Http\Requests\UpdateMarkRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class MarkController extends Controller
{
    /**
     * Display a listing of the mark.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Marks/Index', [
            'marks' => Mark::where('companies_id', Auth::user()->companies_id)->get(),
            'companies' => Company::all(),
            'colors' => Customizer::where('companies_id', $company)->get(),
            'company' => Company::find(Auth::user()->companies_id),
        ]);
    }

    /**
     * Store a newly created mark in storage.
     *
     * @param  \App\Http\Requests\StoreMarkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarkRequest $request)
    {
        Mark::create($request->all());
        return Redirect::route('marks.index')->with('message', 'Marca agregada');
    }

    /**
     * Update the specified mark in storage.
     *
     * @param  \App\Http\Requests\UpdateMarkRequest  $request
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarkRequest $request, $id)
    {
        $mark = Mark::find($id);
        $mark->update($request->all());
        return Redirect::route('marks.index')->with('message', 'Marca actualizada');
    }

    /**
     * Remove the specified mark from storage.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mark = Mark::find($id);
        $mark->delete();
        return Redirect::route('marks.index')->with('message', 'Marca eliminada');
    }
}
