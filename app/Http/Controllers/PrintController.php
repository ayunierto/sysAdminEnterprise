<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customizer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Presentation;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Auth;

// Printer
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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
                'presentation' => Presentation::find($o->presentations_id)->name,
                'price' => $o->price,
                'igv' => $o->igv,
                'subTotal' => $o->subTotal
            ];
        });






/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 *
 * Use a WindowsPrintConnector with the share name to print.
 *
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 *
 *  echo "Hello World" > testfile
 *  copy testfile "\\%COMPUTERNAME%\Receipt Printer"
 *  del testfile
 */
try {
    // Enter the share name for your USB printer here
    // $connector = null;
    $connector = new WindowsPrintConnector("Microsoft Print to PDF");

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    $printer -> text("Hello World!\n");
    $printer -> cut();
    
    /* Close printer */
    $printer -> close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
        
        // return  $order_details;      
        // return view('pdf.invoice', compact('order', 'order_details', 'company', 'customizer'));
        
        // $pdf = Pdf::loadView('pdf.invoice', compact('order', 'order_details', 'company', 'customizer', 'total'));
        
        // return $pdf->download('invoice.pdf');
        // return $pdf->stream('invoice.pdf');
    }
}
