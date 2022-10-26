<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customizer;
use App\Models\Company;
use App\Models\ProofPayment;
use App\Models\Document;
use App\Models\Customer;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\AccountReceivable;
use App\Models\AffectationIgv;
use App\Models\Coin;
use App\Models\Mark;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\PettyCash;
use App\Models\Presentation;
use App\Models\Product;
use App\Models\Quota;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::user()->companies_id;

        return Inertia::render('Orders/Index', [
            'orders' => Order::where('companies_id', $company)->get()->map(function ($p) {
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
                            'mark_name'=>Mark::find(Product::find($d->products_id)->marks_id)->name,
                            'quantity' => $d->quantity,
                            'price' => $d->price,
                            'discount' => $d->discount,
                            'igv' => $d->igv,
                            'subTotal' => $d->subTotal,
                        ];
                    }),
                ];
            }),
            'company' => Company::find($company),
            'colors' => Customizer::where('companies_id', $company)->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Auth::user()->companies_id;
        $query = new SunatController;
        if ($query->exchange_rate() == 'error') {
            $exchange_rate = 0;
        } else {
            $exchange_rate = $query->exchange_rate()['venta'];
        }
        $datosCaja = PettyCash::where('companies_id', $company)->where('state', 1)->get();
        if ($datosCaja == '[]') {
            $dstCajaChica = 0;
        } else {
            $dstCajaChica = $datosCaja;
        }
        return Inertia::render('Orders/Create', [
            'colors' => Customizer::where('companies_id', $company)->get(),
            'company' => Company::find($company),
            'proofPayments' => ProofPayment::all(),
            'documents' => Document::all(),
            'customers' => Customer::where('companies_id', $company)->get(),
            'paymentMethods' => PaymentMethod::all(),
            'coins' => Coin::all(),
            'presentations' => Presentation::where('companies_id', $company)->get(),
            'affectationIgvs' => AffectationIgv::all(),
            'exchange_rate' => $exchange_rate,
            'cajaChica' => $dstCajaChica,
            'nroComprobantes' => sprintf("%08d", Order::where('companies_id', $company)->where('proof_payments_id', 1)->count() + 1),
            'nroFacturas' => sprintf("%08d", Order::where('companies_id', $company)->where('proof_payments_id', 2)->count() + 1),
            'nroBoletas' => sprintf("%08d", Order::where('companies_id', $company)->where('proof_payments_id', 3)->count() + 1),
            'products' => Product::where('companies_id', $company)->get()->map(function ($p) {
                return [
                    'id' => $p->id,
                    'warehouses_id' => $p->warehouses_id,
                    'warehouses_name' => Warehouse::find($p->warehouses_id)->name,
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
                    'order_price' => $p->order_price,
                    'sale_price' => $p->sale_price,
                    'price_by_unit' => $p->price_by_unit,
                    'wholesale_price' => $p->wholesale_price,
                    'special_price' => $p->special_price,
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
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $order = new Order();

        $order->companies_id = $request->companies_id;
        $order->customers_id = $request->customers_id;
        $order->payment_methods_id = $request->payment_methods_id;
        $order->proof_payments_id = $request->proof_payments_id;
        $order->coins_id = $request->coins_id;
        $order->documents_id = $request->documents_id;
        $order->voucher_number = $request->voucher_number;
        $order->exchange_rate = $request->exchange_rate;
        $order->total = $request->total;
        $order->date = $request->date;
        $order->description = $request->description;
        if ($request->totalPago < $request->total) {
            $order->state = 0;
        }
        $order->save();

        $products = $request->products;
        foreach ($products as $key => $value) {
            $order_details = new orderDetail();
            $idProducto = $value['productId'];
            $stockProducto = Product::find($idProducto);
            $order_details->orders_id = $order->id;
            $order_details->products_id = $value['productId'];
            $order_details->affectation_igvs_id = $value['igvAffectationId'];
            $order_details->presentations_id = $value['presentationId'];
            $order_details->quantity = $value['quantity'];
            $order_details->price = $value['sale_price'];
            $order_details->discount = $value['discount'];
            $order_details->igv = $value['igv'];
            $order_details->subTotal = $value['subTotal'];

            $order_details->save();
            $cant = $value['quantity'] * $value['equivalence'];
            if ($value['type'] == 'Producto') {
                $stockProducto->update([
                    $stockProducto->stock -= $cant
                ]);
            }
        }
        if ($request->totalPago < $request->total) {
            $accountReceivable = new AccountReceivable();
            $accountReceivable->companies_id = $request->companies_id;
            $accountReceivable->orders_id = $order->id;
            $accountReceivable->payment = $request->totalPago;
            $accountReceivable->debt = $request->total - $request->totalPago;
            $accountReceivable->save();
        }
        if ($request->nroQuotas > 0) {
            $quotas = $request->quotasVenta;
            foreach ($quotas as $key => $value) {
                $quota = new Quota();
                $quota->orders_id = $order->id;
                $quota->payment_date = $value['dateQuota'];
                $quota->amount = $value['montoQuota'];
                $quota->save();
            }
        }
        $pettyCash = PettyCash::where('companies_id', $request->companies_id)->where('state', 1)->get();
            if ($request->cajaChica == 1 && $request->coins_id == 1) {
                $pettyCash[0]->update([
                    $pettyCash[0]->amount_pen += $request->totalPago,
                ]);
            } else {
                if ($request->cajaChica == 1 && $request->coins_id == 2) {
                    $pettyCash[0]->update([
                        $pettyCash[0]->amount_usd += $request->totalPago,
                    ]);
                }
            }
        // imprimir Comprobante
        // $nombreImpresora = "EPSON L3210 Series";
        // $profile = CapabilityProfile::load("simple");
        // $connector = new WindowsPrintConnector($nombreImpresora);
        // $impresora = new Printer($connector, $profile);
        // $impresora->setJustification(Printer::JUSTIFY_CENTER);
        // $impresora->setTextSize(2, 2);
        // $impresora->text("Imprimiendo\n");
        // $impresora->text("ticket\n");
        // $impresora->text("desde\n");
        // $impresora->text("Laravel\n");
        // $impresora->setTextSize(1, 1);
        // $impresora->text("https://parzibyte.me");
        // $impresora->feed(5);
        // $impresora->close();

        if ($request->print == 1) {
            $print = new PrintController($order->id);
            // PrintController::class;
        }

        return Redirect::route('orders.index')->with('message', 'Venta agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders = Order::find($id);
        $order_details = OrderDetail::where('orders_id', $orders->id)->get();        
        foreach ($order_details as $key => $p) {
            $products=Product::find($p->products_id);
            $products->update([
                $products->stock += $p->quantity,
            ]);
        }
        $orders->delete();
        return Redirect::route('orders.index')->with('message', 'Venta eliminada');
    }
}
