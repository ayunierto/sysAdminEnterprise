<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        .border {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .w-full {
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        thead {
            background: #cccccc;
        }
    </style>
</head>

<body style="font-family: Arial, Helvetica, sans-serif">
    <table class="w-full">
        <tbody>
            <tr>
                <td>
                    <div class="text-center">
                        <h2 style="margin: 0">{{ $company->name }}</h2>
                        <p style="margin: 0; font-size: 11px;">Dirección: {{ $company->ruc }}</p>
                        <p style="margin: 0; font-size: 11px;">Teléfono: {{ $company->phone }}</p>
                    </div>

                </td>
                <td>
                    <table class="border w-full">
                        <tr>
                            <td class="text-center">R.U.C. {{ $company->ruc }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <h3 style="font-size: 14px;"><?php
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
                                ?> N° {{ $order->voucher_number }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">Fecha: {{ $order->date }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table class="border w-full" style="font-size: 0.9rem">
        <thead>
            <tr>
                <th class="border">
                    Cantidad
                </th>
                <th class="border">
                    Descripción
                </th>
                <th class="border">
                    Presentación
                </th>
                <th class="border">
                    Precio
                </th>
                <th class="border">
                    IGV
                </th>
                <th class="border">
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_details as $item)
                <tr>
                    <td class="border" style="padding-left: 10px">{{ $item['quantity'] }}</td>
                    <td class="border" style="padding-left: 10px">{{ $item['product'] }}</td>
                    <td class="border" style="padding-left: 10px">{{ $item['presentation'] }}</td>
                    <td class="border" style="padding-left: 10px">{{ $item['price'] }}</td>
                    <td class="border" style="padding-left: 10px">{{ $item['igv'] }}</td>
                    <td class="border" style="padding-left: 10px">{{ $item['subTotal'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Calculando total- --}}
    @php
        foreach ($order_details as $item) {
            $total += $item['subTotal'];
        }
    @endphp

    <br>
    <table class="border" style="width: 200px; float: right;">
        <thead>
            <tr>
                <th class="border">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border text-center">{{ $total }}</td>
            </tr>
        </tbody>
    </table>

</body>

</html>
