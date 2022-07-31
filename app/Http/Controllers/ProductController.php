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
use App\Models\Provider;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Products/Index', [
            'products' => Product::paginate(10)->map(function ($product)
            {
                return [
                    'id'=> $product->id,

                    'company' => Company::find($product->companies_id)->name,
                    'category' => Category::find( $product->categories_id )->name,
                    'mark' => Mark::find($product->marks_id)->name,
                    'measure' => Measure::find($product->measures_id)->name,
                    'provider' => Provider::find($product->providers_id)->name,
                    'presentation' => Presentation::find($product->presentations_id)->name,

                    'name' => $product->name,
                    'code' => $product->code,
                    'bar_code' => $product->bar_code,
                    'stock' => $product->stock,
                    'purchase_price' => $product->purchase_price,
                    'sale_price' => $product->sale_price,
                    'price_by_unit' => $product->price_by_unit,
                    'wholesale_price' => $product->wholesale_price,
                    'special_price' => $product->special_price,
                    'description' => $product->description,
                    'state' => $product->state,
                    'expiration_date' => $product->expiration_date,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,

                ];
            }),

            'companies' => Company::all(),
            'categories' => Category::all(),
            'marks' => Mark::all(),
            'measures' => Measure::all(),
            'providers' => Provider::all(),
            'presentations' => Presentation::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Products/Create', [
            'companies' => Company::all(),
            'categories' => Category::all(),
            'marks' => Mark::all(),
            'measures' => Measure::all(),
            'providers' => Provider::all(),
            'presentations' => Presentation::all(),
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
        Product::create([

            'companies_id' => $request->company['id'],
            'categories_id' => $request->category['id'],
            'marks_id' => $request->mark['id'],
            'measures_id' => $request->measure['id'],
            'providers_id' => $request->provider['id'],
            'presentations_id' => $request->presentation['id'],
            'name' => $request->name,
            'code' => $request->code,
            'bar_code' => $request->bar_code,
            'stock' => $request->stock,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'price_by_unit' => $request->price_by_unit,
            'wholesale_price' => $request->wholesale_price,
            'special_price' => $request->special_price,
            'description' => $request->description,
            'state' => $request->state,
            'expiration_date' => $request->expiration_date,

        ]);
        return Redirect::route('products.index')->with('message', 'Producto agregado');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
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

        $product = Product::find($id);

        $product->update([
            'companies_id' => $request->company['id'],
            'categories_id' => $request->category['id'],
            'marks_id' => $request->mark['id'],
            'measures_id' => $request->measure['id'],
            'providers_id' => $request->provider['id'],
            'presentations_id' => $request->presentation['id'],
            'name' => $request->name,
            'code' => $request->code,
            'bar_code' => $request->bar_code,
            'stock' => $request->stock,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'price_by_unit' => $request->price_by_unit,
            'wholesale_price' => $request->wholesale_price,
            'special_price' => $request->special_price,
            'description' => $request->description,
            'state' => $request->state,
            'expiration_date' => $request->expiration_date,
        ]);

        return Redirect::route('products.index')->with('message', 'Producto actualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return Redirect::route('products.index')->with('message', 'Producto eliminado');

    }
}
