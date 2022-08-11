<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::user()->companies_id;
        return Inertia::render('Settings/Index', [
            'colors' => Customizer::where('companies_id', $company)->get(),
            'settings' => Customizer::join('companies', 'customizers.companies_id', '=', 'companies.id')->where('companies_id', $company)->get(),
            'company' => Company::find(Auth::user()->companies_id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Revisar para correcto funcionamiento
        $company = Company::find($id);
        $company->update($request->all());
        $personalizer=Customizer::find($id);
        $personalizer->update($request->all());
        return Redirect::route('settings.index');
    }
}
