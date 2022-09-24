<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customizer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LowStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::user()->companies_id;
        $products = Product::select('products.*', 'warehouses.name as nameWarehouse', 'marks.name as nameMark')
            ->join('warehouses', 'products.warehouses_id', '=', 'warehouses.id')
            ->join('marks', 'products.marks_id', '=', 'marks.id')
            ->where('products.companies_id', $company_id)->get();
        $stock_min = [];
        $nrodedatos=0;
        foreach ($products as $key => $p) {
            if ($p->stock <= $p->stock_min) {
                array_push($stock_min, $p);
                $nrodedatos+=1;
            }
        }

        return Inertia::render('LowStocks/Index', [
            'products' => $stock_min,
            'company' => Company::where('id', $company_id)->first(),
            'colors' => Customizer::where('companies_id', $company_id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
