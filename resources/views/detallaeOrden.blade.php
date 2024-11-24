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
            <tr>
                <td>Camiseta</td>
                <td>2</td>
                <td>$19.99</td>
                <td>$39.98</td>
            </tr>
            <tr>
                <td>Pantalón</td>
                <td>1</td>
                <td>$39.99</td>
                <td>$39.99</td>
            </tr>
            <tr>
                <td>Zapatos</td>
                <td>1</td>
                <td>$59.99</td>
                <td>$59.99</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="total">
                <td colspan="3">Total</td>
                <td>$139.96</td>
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

    <h2>Método de Pago</h2>
    <p>Tarjeta de crédito terminada en 1234</p>

    <a href="#" class="btn">Proceder con la Compra</a>
</div>


@endsection