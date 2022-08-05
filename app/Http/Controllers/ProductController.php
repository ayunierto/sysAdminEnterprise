<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Mark;
use App\Models\Measure;
use App\Models\Presentation;
use App\Models\Customizer;
use App\Models\Provider;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::user()->companies_id;

        return Inertia::render('Products/Index', [
            'products' => Product::where('companies_id', $company_id)->get(),
            'companies' => Company::all(),
            'categories' => Category::where('companies_id', $company_id)->get(),
            'marks' => Mark::where('companies_id', $company_id)->get(),
            'measures' => Measure::all(),
            'providers' => Provider::where('companies_id', $company_id)->get(),
            'company' => Company::where('id', $company_id)->first(),
            'colors' => Customizer::where('companies_id', $company)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        if (Auth::user()->role == 'seller') {
            return Redirect::route('products.index')->with('message', 'No tiene permisos para realizar esta acción');
        } else {
            Product::create($request->all());
            return Redirect::route('products.index')->with('message', 'Producto agregado');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        if (Auth::user()->role == 'seller') {
            return Redirect::route('products.index')->with('message', 'No tiene permisos para realizar esta acción');
        } else {
            $product = Product::find($id);
            $product->update($request->all());
            return Redirect::route('products.index')->with('message', 'Producto actualizado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role == 'seller') {
            return Redirect::route('products.index')->with('message', 'No tiene permisos para realizar esta acción');
        } else {
            $product = Product::find($id);
            $product->delete();
            return Redirect::route('products.index')->with('message', 'Producto eliminado');
        }
    }
}
