<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return Inertia::render('Companies/Index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return Inertia::render('Companies/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        Company::create([
            'name' => $request->name,
            'ruc' => $request->ruc,
            'description' => $request->description,
            'phone' => $request->phone,
            'address' => $request->address,
            'department' => $request->department,
            'province' => $request->province,
            'district' => $request->district,
            'country_code' => $request->country_code,
            'state' => $request->state,
        ]);
        return Redirect::route('companies.index')->with('message', 'Empresa creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        // return Inertia::render('Companies/Show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        // return Inertia::render('Companies/Edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::find($id);
        $company->update([
            'name' => $request->name,
            'ruc' => $request->ruc,
            'description' => $request->description,
            'phone' => $request->phone,
            'address' => $request->address,
            'department' => $request->department,
            'province' => $request->province,
            'district' => $request->district,
            'country_code' => $request->country_code,
            'state' => $request->state,
        ]);
        return Redirect::route('companies.index')->with('message', 'Empresa actualizada');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return Redirect::route('companies.index')->with('message', 'Empresa eliminada');

    }
}
