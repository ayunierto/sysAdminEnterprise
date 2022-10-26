<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customizer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Presentation;
use App\Models\Product;
use App\Models\ProofPayment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PrintController extends Controller
{
    
    public function invoice(){
        // Obteniendo el id enviado por url
        $id = $_REQUEST['id'];
        
        $company = Company::find(Auth::user()->companies_id);
        $customizer = Customizer::where('companies_id', Auth::user()->companies_id)->get()[0];
        $total = 0;        
        $order = Order::find($id); // Buscando venta
        $order_details = OrderDetail::where('orders_id', $order->id)->get()->map(function ($o)
        {
            return [
                'quantity' => $o->quantity,
                'product' => Product::find($o->products_id)->name,
                // 'presentation' => Presentation::find($o->presentations_id)->name,
                'price' => $o->price,
                'igv' => $o->igv,
                'subTotal' => $o->subTotal
            ];
        });
        
        // return  $order_details;      
        // return view('pdf.invoice', compact('order', 'order_details', 'company', 'customizer'));
        $pdf = Pdf::setPaper([0,0,226.772,1500], 'portrait')->loadView('pdf.invoice', compact('order', 'order_details', 'company', 'customizer', 'total'));
        
        // return $pdf->download('invoice.pdf');
        return $pdf->stream('invoice.pdf');
    }
}
