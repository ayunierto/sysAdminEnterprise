<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Customizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $company = Auth::user()->companies_id;
        $company_id = Auth::user()->companies_id;

        $data = [];
        for ( $i = 1; $i < 5; $i++ ) {
                $data += [ $i ];
        } 

        $products = Product::where('companies_id', $company)->get();
        $stock_min = [];
        foreach ($products as $key => $p) {
            if ( $p->stock <= $p->stock_min){
                array_push($stock_min, $p);
            } 
        }   


        return Inertia::render('Dashboard', [
            'products' => Product::where('companies_id', $company_id)->count(),
            'colors' => Customizer::where('companies_id', $company)->get(),
            'company' => Company::find( $company_id ),
            'stock_min' => $stock_min,
        ]);
    }
}
