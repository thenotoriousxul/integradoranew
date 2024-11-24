@extends('layouts.app')

@section('content')
    

<style>

    .container-orden {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h1 {
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    .total {
        font-weight: bold;
    }
    .btn {
        display: inline-block;
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
    }
    .ojo
    {
        margin-top: 15px
    }
</style>
<div class="container-orden">
    <h1>Resumen de la Orden</h1>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
                @foreach($contenidoCarrito as $item)
                    <tr data-id="{{ $item['id'] }}">
                        <td class="d-flex justify-content-center">
                            <span class="ojo" style="font-family: 'Inter', sans-serif;">{{ $item['name'] }}</span>
                        </td>
                        <td>
                            <span  name="cantidad"  class="form-control actualizar-cantidad text-center mx-auto" style="width: 80px; font-family: 'Inter', sans-serif;">{{ $item['quantity'] }}</span>
                        </td>
                        <td style="font-family: 'Inter', sans-serif;">${{ number_format($item['price'], 2) }}</td>
                      
                        <td class="subtotal" style="font-family: 'Inter', sans-serif;">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                       
                    </tr>
                @endforeach
        </tbody>
        <tfoot>
            <tr class="total">
                <td colspan="3">Total</td>
                <td class="subtotal" style="font-family: 'Inter', sans-serif;">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <h2>Información de Envío</h2>
    <p>
        Juan Pérez<br>
        Calle Principal 123<br>
        Ciudad, Estado 12345<br>
        País
    </p>


    <a href="{{ route('pago') }}" id="pago" class="btn btn-success mt-3 px-4 py-2" style="font-family: 'Bebas Neue', cursive; font-size: 1.2rem;">Pasar a pagar</a>
</div>


@endsection