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
use App\Custom\Item;

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

        try {
            // Enter the share name for your USB printer here
            $nombre_impresora = "Microsoft Print to PDF";
            // $connector = null;
            $connector = new WindowsPrintConnector($nombre_impresora);

            /* Print a "Hello world" receipt" */
            $printer = new Printer($connector);

            // Vamos a alinear al centro lo próximo que imprimamos
            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            // Encabezado
            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer -> text( $company->name . "\n");

            $printer -> selectPrintMode();

            $printer -> text( $company->address . "\n");
            $printer -> text( $company->phone . "\n");
            $printer -> text( "R.U.C." . $company->ruc . "\n");

            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);            

            $comprobante = $order->proof_payments_id;
            if ($comprobante == 1) {
                $printer -> text( "COMPROBANTE" . "\n");
            }
            if ($comprobante == 2) {
                $printer -> text( "FACTURA" . "\n");
            }
            if ($comprobante == 3) {
                $printer -> text( "BOLETA DE VENTA" . "\n");
            }

            $printer -> selectPrintMode();

            // Imprimir fecha
            $printer->text(date("Y-m-d H:i:s") . "\n");

            $printer->text("--------------------------------------------". "\n");

            // Imprimir productos
            $total = 0;

            $printer->setJustification(Printer::JUSTIFY_LEFT);

            //$items[] = array();
            $items[] = new Item("Cantidad","Descripción","Presentación","Precio", "IGV", "Total");

            foreach ($order_details as $value) {
                //$printer->text($value['nombre'] ."\t".$value['peso_cantidad'] ."\t".$value['precio'] ."\t".$value['preciototal']."\n");
                $items[] = new item($value['quantity'],$value['product'] ,$value['presentation'] ,$value['price'], $value['igv'], $value['subTotal']);
                $total += $value['subTotal'];
            }
            $i = 0;
            foreach ($items as $item) {
                if($i == 0){
                    //$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
                    $printer -> setJustification(Printer::JUSTIFY_CENTER);
                    $printer -> text($item);
                    $printer->text("--------------------------------------------". "\n");
                    $printer -> selectPrintMode();
            
                }else{
                    $printer -> text($item);
                }
                $i++;
            }
            
            /*
                Terminamos de imprimir
                los productos, ahora va el total
            */
            $printer->text("----------------------\n");
            $printer->text("TOTAL: ". $total ."\n");
            // $printer->text("SON ". $total_literal ."\n");

            $printer->text("Muchas gracias por su preferencia...");

            /*Alimentamos el papel 3 veces*/
            $printer->feed(3);

            /*
                Cortamos el papel. Si nuestra impresora
                no tiene soporte para ello, no generará
                ningún error
            */
            $printer->cut();

            /*
                Por medio de la impresora mandamos un pulso.
                Esto es útil cuando la tenemos conectada
                por ejemplo a un cajón
            */
            $printer->pulse();

            /*
                Para imprimir realmente, tenemos que "cerrar"
                la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
            */
            $printer->close();
        } catch (Exception $e) {

            echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";

        }






        // /* Clase de para organizar las columnas */
        
        
        // return  $order_details;      
        // return view('pdf.invoice', compact('order', 'order_details', 'company', 'customizer'));
        
        // $pdf = Pdf::loadView('pdf.invoice', compact('order', 'order_details', 'company', 'customizer', 'total'));
        
        // return $pdf->download('invoice.pdf');
        // return $pdf->stream('invoice.pdf');
    }
}
