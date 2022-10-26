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
use App\Models\Warehouse;
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
            'warehouses' => Warehouse::where('companies_id', $company_id)->get(),
            // 'products' => Product::where('companies_id', $company_id)->where('type', 'Producto')->get(),
            'companies' => Company::all(),
            'categories' => Category::where('companies_id', $company_id)->get(),
            'marks' => Mark::where('companies_id', $company_id)->get(),
            'measures' => Measure::all(),
            'providers' => Provider::where('companies_id', $company_id)->get(),
            'company' => Company::where('id', $company_id)->first(),
            'colors' => Customizer::where('companies_id', $company_id)->get(),
            'products' => Product::where('companies_id', $company_id)->where('type', 'Producto')->get()->map(function ($p) {
                return [
                    'id' => $p->id,
                    'companies_id'=>$p->companies_id,
                    'warehouses_id' => $p->warehouses_id,
                    'categories_id' => $p->categories_id,
                    'marks_id' => $p->marks_id,
                    'marks_name' => Mark::find($p->marks_id)->name,
                    'measures_id' => $p->measures_id,
                    'providers_id' => $p->providers_id,
                    'name' => $p->name,
                    'type' => $p->type,
                    'code' => $p->code,
                    'bar_code' => $p->bar_code,
                    'stock' => $p->stock,
                    'purchase_price' => $p->purchase_price,
                    'sale_price' => $p->sale_price,
                    'price_by_unit' => $p->price_by_unit,
                    'wholesale_price' => $p->wholesale_price,
                    'special_price' => $p->special_price,
                    'stock_min'=> $p->stock_min,
                    'description' => $p->description,
                    'state' => $p->state,
                    // 'presentation' => Presentation::where('products_id', $p->id)->first(),
                ];
            }),
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
            $product=new Product();
            $product->companies_id =$request->companies_id;
            $product->warehouses_id =$request->warehouses_id;
            $product->categories_id =$request->categories_id;
            $product->marks_id =$request->marks_id;
            $product->measures_id =$request->measures_id;
            $product->providers_id =$request->providers_id;
            $product->type ='Producto';
            $product->name =$request->name;
            $product->code =$request->code;
            $product->bar_code =$request->bar_code;
            $product->stock =$request->stock;
            $product->purchase_price =$request->purchase_price;
            $product->sale_price =$request->sale_price;
            $product->price_by_unit =$request->price_by_unit;
            $product->wholesale_price =$request->wholesale_price;
            $product->special_price =$request->special_price;
            $product->stock_min =$request->stock_min;
            $product->description =$request->description;
            $product->expiration_date =$request->expiration_date;
            $product->save();


            // $product = Product::create($request->all());
            // $presenation = new Presentation();
            // $presenation->companies_id = Auth::user()->companies_id;
            // $presenation->products_id = $product->id;
            // $presenation->name = "Unidad";
            // $presenation->equivalence = 1;
            // $presenation->save();

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
