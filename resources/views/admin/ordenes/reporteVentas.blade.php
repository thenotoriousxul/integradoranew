@extends('admin.layouts.dashboard')

@section('content')

<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>N.º Orden</th>
            <th>Fecha Orden</th>
            <th>Cliente/Empleado</th>
            <th>Nombre</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Total Pedido</th>
            <th>Pago Final</th>
            <th>Descuento</th>
            <th>Metodo de Pago</th>
            <th>Estado de Envio</th>
            <th>Direccion de Envio</th>
        </tr>
    </thead>
    {{-- @foreach($ordenes as $orden) --}}
    <tbody>
        <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011-04-25</td>
            <td>$320,800</td>
        </tr>
    </tbody>
    {{-- @endforeach --}}
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </tfoot>
</table>

@endsection