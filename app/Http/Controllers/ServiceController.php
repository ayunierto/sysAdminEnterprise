<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Customizer;
use App\Models\Mark;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::user()->companies_id;

        return Inertia::render('Services/Index', [
            'warehouses' => Warehouse::where('companies_id', $company_id)->get(),
            'services' => Product::where('companies_id', $company_id)->where('type', 'Servicio')->get(),
            'companies' => Company::all(),
            'categories' => Category::where('companies_id', $company_id)->get(),
            'marks' => Mark::where('companies_id', $company_id)->get(),
            'measures' => Measure::all(),
            'providers' => Provider::where('companies_id', $company_id)->get(),
            'company' => Company::where('id', $company_id)->first(),
            'colors' => Customizer::where('companies_id', $company_id)->get(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->role == 'seller') {
            return Redirect::route('services.index')->with('message', 'No tiene permisos para realizar esta acción');
        } else {
            $product = new Product();
            $product->companies_id = $request->companies_id;
            $product->measures_id = $request->measures_id;
            $product->type = 'Servicio';
            $product->name = $request->name;
            $product->code = $request->code;
            $product->stock = 999;
            $product->purchase_price = $request->purchase_price;
            $product->sale_price = $request->sale_price;
            $product->price_by_unit = $request->price_by_unit;
            $product->wholesale_price = $request->wholesale_price;
            $product->special_price = $request->special_price;
            $product->description = $request->description;
            $product->save();

            return Redirect::route('services.index')->with('message', 'Servicio agregado');
        }
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
        if (Auth::user()->role == 'seller') {
            return Redirect::route('services.index')->with('message', 'No tiene permisos para realizar esta acción');
        } else {
            $product = Product::find($id);
            $product->update($request->all());
            return Redirect::route('services.index')->with('message', 'Servicio actualizado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role == 'seller') {
            return Redirect::route('services.index')->with('message', 'No tiene permisos para realizar esta acción');
        } else {
            $product = Product::find($id);
            $product->delete();
            return Redirect::route('services.index')->with('message', 'servicio eliminado');
        }
    }
}
