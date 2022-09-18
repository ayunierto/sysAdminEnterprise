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
                <td >
                    <h2 class="text-center">{{ $company->name }}</h2>
                </td>
                <td style="font-size: 0.8rem">
                    <p>Oficina: {{ $company->address }}</p>
                    <p>Código Postal: {{ $company->country_code }}</p>
                    <p>Página Web:</p>
                    <p>Teléfono: {{ $company->phone }}</p>
                </td>
                <td>
                    <table class="border w-full">
                        <tr>
                            <td class="text-center">R.U.C. {{ $company->ruc }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><h3>BOLETA DE VENTA <br> ELECTRONICA</h3></td>
                        </tr>
                        <tr>
                            <td class="text-center">No. {{ $order->voucher_number }}</td>
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
    
    <table  class="border w-full" style="font-size: 0.9rem">
        <thead>
            <tr>
                <th  class="border">
                    Cantidad
                </th>
                <th  class="border">
                    Descripción 
                </th>
                <th  class="border">
                    Presentación 
                </th>
                <th  class="border">
                    Precio 
                </th>
                <th  class="border">
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