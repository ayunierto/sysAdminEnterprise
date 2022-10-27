<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customizer;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\CashRegister;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Mark;
use App\Models\Presentation;
use App\Models\Provider;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
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
        $company = Auth::user()->companies_id;
        $companies = Company::all();
        return Inertia::render('Companies/Index', [
            'companies' => $companies,
            'colors' => Customizer::where('companies_id', $company)->get(),
            'company' => Company::find(Auth::user()->companies_id),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->all());
        // agregar un cliente general
        $customer = new Customer();
        $customer->companies_id = $company->id;
        $customer->name = "Cliente General";
        $customer->document  = 0;
        $customer->save();
        //agregar un proveedor general
        $provider = new Provider();
        $provider->companies_id = $company->id;
        $provider->name = "Proveedor General";
        $provider->document  = 0;
        $provider->save();
        //agregar un almacén general
        $warehouse = new Warehouse();
        $warehouse->companies_id = $company->id;
        $warehouse->name = "Almacén General";
        $warehouse->contact_number  = 000000000;
        $warehouse->save();
        // agregar un cliente general
        $cashRegister = new CashRegister();
        $cashRegister->companies_id = $company->id;
        $cashRegister->description = "Caja General";
        $cashRegister->amount_pen = 0;
        $cashRegister->amount_usd = 0;
        $cashRegister->save();
        //agregar un Presentación general
        $presenation = new Presentation();
        $presenation->companies_id = $company->id;
        $presenation->name = "Unidad";
        $presenation->equivalence = 1;
        $presenation->save();

        //agregar un Categoria general
        $categoria = new Category();
        $categoria->companies_id = $company->id;
        $categoria->name = "Sin Categoria";
        $categoria->save();

        //agregar un marca general
        $marca = new Mark();
        $marca->companies_id = $company->id;
        $marca->name = "Sin Marca";
        $marca->save();

        // agregar una personalizacion 
        Customizer::create([
            'companies_id' => $company->id,
            'color_menu' => '#3F51B5',
            'color_sub_menu' => '#3F51B5',
            'color_header' => '#3F51B5',
            'color_footer' => '#3F51B5',
            'color_text' => '#FFCDD2',
            'logo' => '/img/logo_user.png'
        ]);
        return Redirect::route('companies.index')->with('message', 'Empresa agregada');
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
        $company->update($request->all());
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
