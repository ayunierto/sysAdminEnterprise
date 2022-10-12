<?php

namespace App\Http\Controllers;

use App\Models\AccountPayable;
use App\Models\AccountReceivable;
use App\Models\Company;
use App\Models\Product;
use App\Models\Customizer;
use App\Models\Order;
use App\Models\PettyCash;
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
        $company_id = Auth::user()->companies_id;
        $products = Product::select('products.*', 'warehouses.name as nameWarehouse', 'marks.name as nameMark')
            ->join('warehouses', 'products.warehouses_id', '=', 'warehouses.id')
            ->join('marks', 'products.marks_id', '=', 'marks.id')
            ->where('products.companies_id', $company_id)->get();
        $stock_min = [];
        foreach ($products as $key => $p) {
            if ($p->stock <= $p->stock_min) {
                array_push($stock_min, $p);
            }
        }
        $DateAndTime = date('Y-m-d');
        $totalV = Order::where('companies_id', $company_id)->where('date', $DateAndTime)
            ->where('coins_id', 1)->get();
        $totalVentasDiaSoles = 0;
        foreach ($totalV as $key => $p) {
            $totalVentasDiaSoles += $p->total;
        }
        $totalVd = Order::where('companies_id', $company_id)->where('date', $DateAndTime)
            ->where('coins_id', 2)->get();
        $totalVentasDiaDolares = 0;
        foreach ($totalVd as $key => $p) {
            $totalVentasDiaDolares += $p->total;
        }
        $cajaChSoles=0;
        $cajaChDolares=0;
        $datosCaja = PettyCash::where('companies_id', $company_id)->where('state', 1)->get();
        if ($datosCaja == '[]') {
            $cajaChSoles=0;
            $cajaChDolares=0;
        } else {
            $cajaChSoles = $datosCaja[0]->amount_pen;
            $cajaChDolares = $datosCaja[0]->amount_usd;
        }
        return Inertia::render('Dashboard', [
            'products' => Product::where('companies_id', $company_id)->where('type', 'Producto')->count(),
            'services' => Product::where('companies_id', $company_id)->where('type', 'Servicio')->count(),
            'accountsR' => AccountReceivable::where('companies_id', $company_id)->where('state', 0)->count(),
            'accountsP' => AccountPayable::where('companies_id', $company_id)->where('state', 0)->count(),
            'orders' => Order::where('companies_id', $company_id)->where('date', $DateAndTime)->count(),
            'purchases' => Purchase::where('companies_id', $company_id)->where('date', $DateAndTime)->count(),
            'colors' => Customizer::where('companies_id', $company_id)->get(),
            'company' => Company::find($company_id),
            'totalVentSol' => number_format($totalVentasDiaSoles, 2),
            'totalVentDolar' => number_format($totalVentasDiaDolares, 2),
            'cajaChicaSoles' => $cajaChSoles,
            'cajaChicaDolares' => $cajaChDolares,
        ]);
    }
}
