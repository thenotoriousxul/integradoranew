@extends('admin.layouts.dashboard')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
    
        table {
            color: #e2e8f0;
            background-color: #212529 !important; 
        }
        .form-control, .form-select {
            background-color: #2d3748;
            color: #e2e8f0;
            border-color: #4a5568;
        }
        .form-control:focus, .form-select:focus {
            background-color: #2d3748;
            color: #e2e8f0;
        }
        .ordenes
        {
            background-color: #1f2937;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-4 ">

        <button id="agregar-cliente" class="btn btn-primary mb-4">
            <i class="fas fa-plus me-2"></i>Agregar Cliente
        </button>
        
        <form id="search-form" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <select id="search-field" class="form-select">
                        <option value="">Buscar por</option>
                        <option value="matricula">ID</option>
                        <option value="nombre">Playera</option>
                        <option value="apellido">Edición</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" id="search-input" class="form-control" placeholder="Buscar">
                </div>
                <div class="col-md-2">
                    <input type="date" id="start-date" class="form-control" aria-label="Fecha desde">
                </div>
                <div class="col-md-2">
                    <input type="date" id="end-date" class="form-control" aria-label="Fecha hasta">
                </div>
                <div class="col-md-2">
                    <button type="submit" id="search-btn" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>Buscar
                    </button>
                </div>
            </div>
        </form>

        <div class="table-responsive ordenes">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Total</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ORD002</td>
                        <td>María García</td>
                        <td>iPhone 13</td>
                        <td>1</td>
                        <td>$800.00</td>
                        <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#editarProductoModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection