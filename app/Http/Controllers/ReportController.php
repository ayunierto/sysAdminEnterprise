<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Customizer;
use App\Models\Document;
use App\Models\Mark;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProofPayment;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;
use PhpParser\Node\Expr\Cast\Object_;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($dateInicio = null, $dateFin = null)
    {

        $company = Auth::user()->companies_id;
        if ($dateInicio == null) {
            $DateAndTimeInicio = date('Y-m-d');
        } else {
            $DateAndTimeInicio = $dateInicio;
        }
        if ($dateFin == null) {
            $DateAndTimeFin = date('Y-m-d');
        } else {
            $DateAndTimeFin = $dateFin;
        }
        // VENTAS 
        $totalVentasDiaSoles = 0;
        $totalVentasDiaDolares = 0;
        $total_pen_usd = 0;

        $total_pen = Order::where('companies_id', $company)->whereBetween('date', [$DateAndTimeInicio, $DateAndTimeFin])->where('coins_id', 1)->get();

        foreach ($total_pen as $key => $p) {
            $totalVentasDiaSoles += $p->total;
        }
        $total_usd = Order::where('companies_id', $company)->whereBetween('date', [$DateAndTimeInicio, $DateAndTimeFin])->where('coins_id', 2)->get();

        foreach ($total_usd as $key => $p) {
            $totalVentasDiaDolares += ($p->total * $p->exchange_rate);
        }
        $total_pen_usd = ($totalVentasDiaSoles + round($totalVentasDiaDolares));

        // COMPRAS
        $totalComprasDiaSoles = 0;
        $totalComprasDiaDolares = 0;
        $totalC_pen_usd = 0;

        $totalC_pen = Purchase::where('companies_id', $company)->whereBetween('date', [$DateAndTimeInicio, $DateAndTimeFin])->where('coins_id', 1)->get();

        foreach ($totalC_pen as $key => $p) {
            $totalComprasDiaSoles += $p->total;
        }
        $totalC_usd = Purchase::where('companies_id', $company)->whereBetween('date', [$DateAndTimeInicio, $DateAndTimeFin])->where('coins_id', 2)->get();

        foreach ($totalC_usd as $key => $p) {
            $totalComprasDiaDolares += ($p->total * $p->exchange_rate);
        }
        $totalC_pen_usd = ($totalComprasDiaSoles + round($totalComprasDiaDolares));

        // PRODUCTOS
        $totInversion = 0;
        $number_products = Product::where('companies_id', $company)->get();

        foreach ($number_products as $key => $p) {
            $totInversion += ($p->purchase_price * $p->stock);
        }

        // Obtener ganancias del dia
        $total_ganancia = 0;
        $gananciaTotal = Order::join("order_details", "orders.id", "=", "order_details.orders_id")->join("products", "products.id", "=", "order_details.products_id")->where('orders.companies_id', $company)->whereBetween('orders.date', [$DateAndTimeInicio, $DateAndTimeInicio])->select("products.purchase_price", "order_details.quantity")->get();
        foreach ($gananciaTotal as $key => $p) {
            $total_ganancia += ($p->purchase_price * $p->quantity);
        }
        return Inertia::render('Reports/Index', [
            // Datos Ventas
            'totalVentas' => number_format((round($total_pen_usd)), 2),
            'totalPrecioCompra' => number_format((round($total_pen_usd - $total_ganancia)), 2),
            'totOrders' => Order::where('companies_id', $company)->whereBetween('date', [$DateAndTimeInicio, $DateAndTimeFin])->count(),
            // N° Compras
            'totalCompras' => number_format((round($totalC_pen_usd)), 2),
            // N° Productos
            'totProducts' => Product::where('companies_id', $company)->count(),
            'inversionTotal' => number_format($totInversion, 2),
            // lista Ventas
            'orders' => Order::where('companies_id', $company)->whereBetween('date', [$DateAndTimeInicio, $DateAndTimeFin])->get()->map(function ($p) {
                return [
                    'id' => $p->id,
                    'companies_id' => $p->companies_id,
                    'company_name' => Company::find($p->companies_id)->name,
                    'customers_id' => $p->customers_id,
                    'customers_name' => Customer::find($p->customers_id)->name,
                    'payment_methods_id' => $p->payment_methods_id,
                    'payment_method' => PaymentMethod::find($p->payment_methods_id)->description,
                    'proof_payments_id' => $p->proof_payments_id,
                    'proof_payment' => ProofPayment::find($p->proof_payments_id)->name,
                    'coins_id' => $p->coins_id,
                    'coin' => Coin::find($p->coins_id)->code,
                    'documents_id' => $p->documents_id,
                    'documents_name' => Document::find($p->documents_id)->name,
                    'voucher_number' => $p->voucher_number,
                    'exchange_rate' => $p->exchange_rate,
                    'total' => $p->total,
                    'date' => $p->date,
                    'state' => $p->state,
                    'state_name' => $p->state == 1 ? 'Registrado' : 'Pendiente',
                    'description' => $p->description,
                    'details' => OrderDetail::where('orders_id', $p->id)->get()->map(function ($d) {
                        return [
                            'id' => $d->id,
                            'orders_id' => $d->orders_id,
                            'products_id' => $d->products_id,
                            'product_name' => Product::find($d->products_id)->name,
                            'product_purchase_price' => Product::find($d->products_id)->purchase_price,
                            'quantity' => $d->quantity,
                            'price' => $d->price,
                            'discount' => $d->discount,
                            'igv' => $d->igv,
                            'subTotal' => $d->subTotal,
                        ];
                    }),
                ];
            }),
            'totPurchases' => Purchase::where('companies_id', $company)->whereBetween('date', [$DateAndTimeInicio, $DateAndTimeFin])->count(),
            // Lista de Compras
            'purchases' => Purchase::where('companies_id', $company)->whereBetween('date', [$DateAndTimeInicio, $DateAndTimeFin])->get()->map(function ($p) {
                return [
                    'id' => $p->id,
                    'companies_id' => $p->companies_id,
                    'company_name' => Company::find($p->companies_id)->name,
                    'providers_id' => $p->providers_id,
                    'provider_name' => Provider::find($p->providers_id)->name,
                    'payment_methods_id' => $p->payment_methods_id,
                    'payment_method' => PaymentMethod::find($p->payment_methods_id)->description,
                    'proof_payments_id' => $p->proof_payments_id,
                    'proof_payment' => ProofPayment::find($p->proof_payments_id)->name,
                    'coins_id' => $p->coins_id,
                    'coin' => Coin::find($p->coins_id)->code,
                    'voucher_number' => $p->voucher_number,
                    'total' => $p->total,
                    'date' => $p->date,
                    'state' => $p->state,
                    'exchange_rate' => $p->exchange_rate,
                    'state_name' => $p->state == 1 ? 'Registrado' : 'Pendiente',
                    'description' => $p->description,
                    'details' => PurchaseDetail::where('purchases_id', $p->id)->get()->map(function ($d) {
                        return [
                            'id' => $d->id,
                            'companies_id' => $d->companies_id,
                            'purchases_id' => $d->purchases_id,
                            'products_id' => $d->products_id,
                            'product_name' => Product::find($d->products_id)->name,
                            'amount' => $d->amount,
                            'price' => $d->price,
                            'transporte' => $d->transporte,
                            'igv' => $d->igv,
                            'subTotal' => $d->total,
                        ];
                    }),
                ];
            }),
            // Lista Productos
            'products' => Product::where('companies_id', $company)->get()->map(function ($p) {
                return [
                    'id' => $p->id,
                    'companies_id' => $p->companies_id,
                    'warehouses_id' => $p->warehouses_id,
                    'categories_id' => $p->categories_id,
                    'marks_id' => $p->marks_id,
                    'marks_name' => Mark::find($p->marks_id)->name,
                    'measures_id' => $p->measures_id,
                    'providers_id' => $p->providers_id,
                    'type' => $p->type,
                    'name' => $p->name,
                    'code' => $p->code,
                    'bar_code' => $p->bar_code,
                    'stock' => $p->stock,
                    'purchase_price' => $p->purchase_price,
                    'sale_price' => $p->sale_price,
                    'price_by_unit' => $p->price_by_unit,
                    'wholesale_price' => $p->wholesale_price,
                    'special_price' => $p->special_price,
                    'stock_min' => $p->stock_min,
                    'description' => $p->description,
                    'state' => $p->state,
                    'expiration_date' => $p->expiration_date,
                    'totalInversion' => number_format(($p->purchase_price * $p->stock), 2),
                ];
            }),
            'colors' => Customizer::where('companies_id', $company)->get(),
            'company' => Company::find(Auth::user()->companies_id),
            'warehouses' => Warehouse::where('companies_id', $company)->get(),
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