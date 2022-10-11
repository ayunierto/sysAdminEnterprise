<?php

namespace App\Http\Controllers;

use App\Models\PrintingMachine;
use App\Http\Requests\StorePrintingMachineRequest;
use App\Http\Requests\UpdatePrintingMachineRequest;
use App\Models\Company;
use App\Models\Customizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PrintingMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::user()->companies_id;

        return Inertia::render('PrintingMachines/Index', [
            'printingMachines' => PrintingMachine::where('companies_id', $company_id)->get(),
            'company' => Company::where('id', $company_id)->first(),
            'companies' => Company::all(),
            'colors' => Customizer::where('companies_id', $company_id)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrintingMachineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrintingMachineRequest $request)
    {
        PrintingMachine::create($request->all());
        return Redirect::route('printingMachines.index')->with('message', 'Impresora Agregada');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrintingMachineRequest  $request
     * @param  \App\Models\PrintingMachine  $printingMachine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrintingMachineRequest $request, $id)
    {
        $printingMachine = PrintingMachine::find($id);
        $printingMachine->update($request->all());
        return Redirect::route('printingMachines.index')->with('message', 'Datos Actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrintingMachine  $printingMachine
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $printingMachine = PrintingMachine::find($id);
        $printingMachine->delete();
        return Redirect::route('printingMachines.index')->with('message', 'Impresora eliminada');
    }
}
