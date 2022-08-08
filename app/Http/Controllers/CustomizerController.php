<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomizerRequest;
use App\Http\Requests\UpdateCustomizerRequest;

use App\Models\Customizer;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
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
            'customizers' => Customizer::select('customizers.*', 'companies.*')->join('companies', 'customizers.companies_id', '=', 'companies.id')->get(),
            'colors' => Customizer::where('companies_id', $company)->get(),
            'companies' => Company::all(),
            'company' => Company::find($company),
            Company::where('id', 2)->get(),
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

        // $cod= $request->companies_id;
        // $nombre='logo_empresa'.$cod.'.'.$request->logo->getClientOriginalExtension();;
        // $destino=public_path('/img/empresas/logos');

        // Customizer::create([
        //     'companies_id' => $request->companies_id,
        //     'color_menu' => $request->color_menu,
        //     'color_sub_menu' => $request->color_sub_menu,
        //     'color_header' => $request->color_header,
        //     'color_footer' => $request->color_footer,
        //     'color_text' =>$request->color_text,
        //     'logo' => $request->logo->move($destino,$nombre),
        // ]);
        // return Redirect::route('customizers.index')->with('message', 'Colores Asignados');
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
