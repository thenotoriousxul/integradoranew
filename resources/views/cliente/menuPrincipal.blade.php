<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard del Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .sidebar {
            background-color: #000;
            min-height: 100vh;
            transition: all 0.3s;
        }
        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            padding: 10px 20px;
            margin-bottom: 5px;
            border-radius: 0;
            transition: background-color 0.3s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #333;
        }
        .main-content {
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-title {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-primary {
            background-color: #000;
            border: none;
            border-radius: 0;
            padding: 8px 16px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .btn-primary:hover {
            background-color: #333;
        }
        .table {
            font-size: 0.9rem;
        }
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .top-bar {
            background-color: #000;
            color: #fff;
            padding: 10px 0;
            margin: 0;
            left: 0;

            width: 100vw; /* Asegura que ocupe todo el ancho */
            position: relative; /* Permite que se superponga correctamente */
            z-index: 10; /* Prioriza el contenido sobre otros elementos */
        }
        .top-bar h1 {
            font-size: 1.2rem;
            margin: 0;
        }
        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 80%;
                height: 100%;
                z-index: 1000;
            }
            .sidebar.show {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }

        .sidebar .btn-link {
            text-align: left;
            padding: 10px 20px;
            width: 100%;
        }

        @media (max-width: 767.98px) {
            .sidebar .btn-link {
                display: block;
            }
        }

    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Menú lateral -->
                <nav class="col-md-3 col-lg-2 sidebar d-md-block collapse">
                    <div class="position-sticky pt-3">
                        <!-- Botón de cerrar (solo visible en pantallas pequeñas) -->
                        <button class="btn btn-link text-white d-md-none mb-3" onclick="toggleSidebar()">
                            <i class="bi bi-x-circle"></i> Close
                        </button>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">
                                    <i class="bi bi-house-door me-2"></i> Inicio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-cart me-2"></i> Pedidos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-heart me-2"></i> Favoritos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-person me-2"></i> Perfil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-question-circle me-2"></i> Ayuda
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>


            <!-- Contenido principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="top-bar d-flex justify-content-between align-items-center">
                    <button class="btn btn-link d-md-none me-3" type="button" onclick="toggleSidebar()">
                        <i class="bi bi-list text-white"></i>
                    </button>
                    <h1>Dashboard</h1>
                    <div>
                        <i class="bi bi-bell text-white me-3"></i>
                        <i class="bi bi-person-circle text-white"></i>
                    </div>
                </div>

                <div class="main-content">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Resumen de Pedidos</h5>
                                    <p class="card-text">3 pedidos en proceso</p>
                                    <a href="#" class="btn btn-primary">Ver Pedidos</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Favoritos</h5>
                                    <p class="card-text">5 productos en tu lista</p>
                                    <a href="#" class="btn btn-primary">Ver Favoritos</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Historial de Compras</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2023-05-01</td>
                                            <td>Camiseta Negra</td>
                                            <td>2</td>
                                            <td>$39.98</td>
                                        </tr>
                                        <tr>
                                            <td>2023-04-15</td>
                                            <td>Pantalón Vaquero</td>
                                            <td>1</td>
                                            <td>$59.99</td>
                                        </tr>
                                        <tr>
                                            <td>2023-03-30</td>
                                            <td>Zapatillas Deportivas</td>
                                            <td>1</td>
                                            <td>$89.99</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
</body>
</html>