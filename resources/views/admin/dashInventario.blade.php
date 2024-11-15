@extends('admin.layouts.dashboard')

@section('content')
<style>
    body {
        background-color: #1a202c;
        color: #e2e8f0;
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
    .product-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }
    .visualizer {
        background-color: #2d3748;
        border-radius: 8px;
        padding: 20px;
        display: none;
        position: fixed;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        width: 300px;
        z-index: 1000;
        box-shadow: 0 0 15px rgba(0,0,0,0.5);
    }
    .visualizer img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        max-height: 200px;
        object-fit: contain;
    }
    .table-hover tbody tr:hover {
        cursor: pointer;
        background-color: rgba(255,255,255,0.1) !important;
    }
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        display: none;
        z-index: 999;
    }
</style>
</head>
<body>
<div class="container-fluid mt-4">
    <h1 class="mb-4">Gestión de Inventario</h1>
    
    <form id="search-form" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="search-field" class="form-label">Buscar por:</label>
                <select id="search-field" class="form-select">
                    <option value="id">ID</option>
                    <option value="producto">Producto</option>
                    <option value="precio">Precio</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="search-input" class="form-label">Término de búsqueda:</label>
                <input type="text" id="search-input" class="form-control" placeholder="Buscar">
            </div>
            <div class="col-md-2">
                <label for="start-date" class="form-label">Desde:</label>
                <input type="date" id="start-date" class="form-control">
            </div>
            <div class="col-md-2">
                <label for="end-date" class="form-label">Hasta:</label>
                <input type="date" id="end-date" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" id="search-btn" class="btn btn-primary w-100">
                    <i class="fas fa-search me-2"></i>Buscar
                </button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr data-id="1741D">
                    <td>1741D</td>
                    <td>
                        <img src="img/playera.jpeg" alt="Dollan watch" class="product-img me-2">
                        Dollan watch
                    </td>
                    <td>$ 123</td>
                    <td>1108</td>
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
                <tr data-id="1742D">
                    <td>1742D</td>
                    <td>
                        <img src="img/reloj.jpeg" alt="Reloj Elegante" class="product-img me-2">
                        Reloj Elegante
                    </td>
                    <td>$ 250</td>
                    <td>500</td>
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

<div id="visualizer" class="visualizer">
    <img id="product-image" src="" alt="Producto" class="img-fluid mb-3">
    <h2 id="product-title"></h2>
    <p><strong>Stock:</strong> <span id="product-stock"></span></p>
    <p><strong>Precio:</strong> <span id="product-price"></span></p>
    <p id="product-status" class="badge"></p>
</div>

<div id="overlay" class="overlay"></div>
<script src="{{ asset('js/productoinventario.js') }}" defer></script>

@endsection