<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Customizer;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\Warehouse;
use Faker\Core\Number;
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

        // $data = [];
        // for ( $i = 1; $i < 5; $i++ ) {
        //         $data += [ $i ];
        // } 

        // $products = Product::where('companies_id', $company)->get();
        $products=Product::select('products.*', 'warehouses.name as nameAlmacen')->join('warehouses', 'products.warehouses_id', '=', 'warehouses.id')->where('products.companies_id', $company)->get();
        $stock_min = [];
        foreach ($products as $key => $p) {
            if ( $p->stock <= $p->stock_min){
                array_push($stock_min, $p);
            } 
        }   
        // 'customizers' => Customizer::select('customizers.*', 'companies.name')->join('companies', 'customizers.companies_id', '=', 'companies.id')->get(),
        $DateAndTime = date('Y-m-d');
        $totalV=Order::where('companies_id', $company)->where('date', $DateAndTime)->get();
        $totalVentasDia = 0;
        foreach ($totalV as $key => $p) {
            $totalVentasDia+=$p->total;
        }
        
        return Inertia::render('Dashboard', [
            'products' => Product::where('companies_id', $company_id)->count(),
            'orders' => Order::where('companies_id', $company_id)->where('date', $DateAndTime)->count(),
            'purchases' => Purchase::where('companies_id', $company_id)->where('date', $DateAndTime)->count(),
            'colors' => Customizer::where('companies_id', $company)->get(),
            'company' => Company::find( $company_id ),
            'stock_min' => $stock_min,
            'totalVent' => number_format($totalVentasDia, 2),
        ]);
    }
}
