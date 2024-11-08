@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Dashboard de Administrador</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total de Ventas</h5>
                    <p class="card-text">$150,000.00</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Productos en Inventario</h5>
                    <p class="card-text">120</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Pendientes</h5>
                    <p class="card-text">35</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <a href="#" class="btn btn-primary">Gestionar Productos</a>
        <a href="#" class="btn btn-secondary">Ver Pedidos</a>
        <a href="{{route ('agregar.producto')}}" class="btn btn-secondary">agregar Producto</a>
    </div>
</div>


@endsection
