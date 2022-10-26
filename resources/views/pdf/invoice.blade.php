<?php
$medidaTicket = 180;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        td,
        th,
        tr,
        table {
            /* border-top: 1px solid black; */
            border-collapse: collapse;
            margin: 0 auto;
        }

        td.cantidad {
            font-size: 11px;
        }

        td.producto {
            text-align: justify;
        }

        td.precio {
            text-align: right;
            font-size: 11px;
        }

        td.subTot {
            text-align: right;
            font-size: 11px;
        }


        th {
            text-align: center;
        }

        h1 {
            font-size: 18px;
            margin: 0
        }

        h2 {
            margin: 0;
            font-weight: lighter;
        }

        h3 {
            font-size: 10px;
            font-weight: bold;
        }

        h6 {
            margin: 0;
            font-weight: lighter;
            text-align: justify;
            font-size: 11px;
        }

        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }

        .contenedor {
            text-align: center;
            align-content: center;
            margin: 0
        }

        body {
            text-align: center;
        }
    </style>
</head>
<br>

<body>
    <div class="contenedor">
        <h1>{{ $company->name }}</h1>
        <h2>R.U.C. {{ $company->ruc }}</h2>
        <h6>Dirección: {{ $company->address }}</h6>
        <h6>Teléfono: {{ $company->phone }}</h6>
        <h6>Fecha: {{ $order->date }}</h6>

        <h3><?php
        $comprobante = $order->proof_payments_id;
        if ($comprobante == 1) {
            echo strtoupper('Comprobante');
        }
        if ($comprobante == 2) {
            echo strtoupper('Factura');
        }
        if ($comprobante == 3) {
            echo strtoupper('Boleta de Venta');
        }
        ?> N°. {{ $order->voucher_number }}</h3>
    </div>
    <table>
        <thead>
            <tr class="centrado" style="border-bottom: 1px solid black; ">
                <th class="cantidad">CANT.</th>
                <th class="producto">PROD.&nbsp;</th>
                <th class="precio">PREC.&nbsp;</th>
                <th class="subTot">TOT.&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_details as $item)
                <tr class="centrado">
                    <td class="cantidad">{{ $item['quantity'] }}</td>
                    <td class="producto">{{ $item['product'] }}</td>
                    <td class="precio"> {{ $item['price'] }}</td>
                    <td class="subTot"> {{ $item['quantity'] * $item['price'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <br>
    </table>
    {{-- Calculando total- --}}
    @php
        $igvs = 0;
        foreach ($order_details as $item) {
            $total += $item['quantity'] * $item['price'];
            $igvs += $item['igv'];
        }
        
    @endphp
    <table FRAME="border" RULES="none">
        <tr>
            <td>IGV: </td>
            <td>{{ $igvs }}</td>
        </tr>
        <tr>
            <td>Total Parcial:</td>
            <td> {{ $total }}</td>
        </tr>
        <tr>
            <td>Total:</td>
            <td> {{ round($total + $igvs) }}</td>
        </tr>
    </table>

    <br>
    <p class="contenedor">¡GRACIAS POR SU COMPRA!
        <br>{{ $company->name }}
    </p>
</body>

</html>
