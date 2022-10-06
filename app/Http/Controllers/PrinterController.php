<?php

namespace App\Http\Controllers;

use App\Models\Printer;
use App\Http\Requests\StorePrinterRequest;
use App\Http\Requests\UpdatePrinterRequest;
use App\Models\Company;
use App\Models\Customizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::user()->companies_id;

        return Inertia::render('Printers/Index', [
            'printers' => Printer::where('companies_id', $company_id)->get(),
            'company' => Company::where('id', $company_id)->first(),
            'companies' => Company::all(),
            'colors' => Customizer::where('companies_id', $company_id)->get(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrinterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrinterRequest $request)
    {
        Printer::create($request->all());
        return Redirect::route('printers.index')->with('message', 'Impresora Agregada');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrinterRequest  $request
     * @param  \App\Models\Printer  $printer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrinterRequest $request, $id)
    {
        $printer = Printer::find($id);
        $printer->update($request->all());
        return Redirect::route('printers.index')->with('message', 'Datos Actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Printer  $printer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $printer = Printer::find($id);
        $printer->delete();
        return Redirect::route('printers.index')->with('message', 'Impresora eliminada');
    }
}
