<?php

namespace App\Http\Controllers;

use App\Models\Measure;
use App\Http\Requests\StoreMeasureRequest;
use App\Http\Requests\UpdateMeasureRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class MeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Measures/Index', [
            'measures' => Measure::all()->map(function ($measure) {
                return [
                    'id' => $measure->id,
                    'code' => $measure->code,
                    'name' => $measure->name,
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Measures/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMeasureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeasureRequest $request)
    {
        Measure::create([
            'code' => $request->code,
            'name' => $request->name,
        ]);
        return Redirect::route('measures.index')->with('message', 'Unidad de Medida agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Measure  $measure
     * @return \Illuminate\Http\Response
     */
    public function show(Measure $measure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Measure  $measure
     * @return \Illuminate\Http\Response
     */
    public function edit(Measure $measure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMeasureRequest  $request
     * @param  \App\Models\Measure  $measure
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMeasureRequest $request, $id)
    {
        $measure = Measure::find($id);
        $measure->update([
            'code' => $request->code,
            'name' => $request->name,
        ]);
        return Redirect::route('measures.index')->with('message', 'Unidad de Medida actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Measure  $measure
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $measure = Measure::find($id);
        $measure->delete();
        return Redirect::route('measures.index')->with('message', 'Unidad de Medida eliminada');
    }
}