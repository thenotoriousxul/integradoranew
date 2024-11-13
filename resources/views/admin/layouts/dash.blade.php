<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            transition: all 0.3s ease-in-out;
        }
        .sidebar.collapsed {
            margin-left: -250px;
        }
        .content {
            transition: all 0.3s ease-in-out;
        }
        .content.expanded {
            margin-left: 0;
        }
        .card {
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .nav-link {
            transition: all 0.2s ease-in-out;
        }
        .nav-link:hover {
            transform: translateX(5px);
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .slide-in {
            animation: slideIn 0.5s ease-in-out;
        }
        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Sidebar -->
            <div id="sidebar" class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Admin Dashboard</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Inicio</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Usuarios</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Productos</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi bi-basket3"></i> <span class="ms-1 d-none d-sm-inline">Provedores</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                 <i class="fs-4 bi-display"></i> <span class="ms-1 d-none d-sm-inline">Empleados</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-bar-chart"></i> <span class="ms-1 d-none d-sm-inline">Estadísticas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Main Content -->
            <div id="content" class="col py-3 content">
                <!-- Top Navigation Bar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <button id="sidebarToggle" class="btn btn-outline-secondary me-2">
                            <i class="bi bi-list"></i>
                        </button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Admin User
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                
                <!-- Dashboard Content -->
                <h2 class="slide-in">Panel de Control</h2>
                <div class="container mt-4">
                @yield('content')
                </div> 
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('expanded');
        });

        // Simulación de datos en tiempo real con animación
       /* function updateCounts() {
            const elements = [
                { id: 'userCount', max: 200 },
                { id: 'productCount', max: 100 },
                { id: 'salesCount', max: 15000, prefix: '$' },
                { id: 'orderCount', max: 35 }
            ];

            elements.forEach(el => {
                const element = document.getElementById(el.id);
                const newValue = Math.floor(Math.random() * el.max) + 1;
                animateValue(element, parseInt(element.textContent.replace('$', '')), newValue, 1000, el.prefix);
           });
        }
        */ 

        function animateValue(obj, start, end, duration, prefix = '') {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.textContent = prefix + Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        setInterval(updateCounts, 5000); // Actualiza cada 5 segundos

        // Simulación de carga de pedidos con animación
        function loadOrders() {
            const orders = [
                { id: 1, cliente: 'Juan Pérez', fecha: '2023-11-01', total: '$150', estado: 'Completado' },
                { id: 2, cliente: 'María García', fecha: '2023-11-02', total: '$200', estado: 'En proceso' },
                { id: 3, cliente: 'Carlos López', fecha: '2023-11-03', total: '$100', estado: 'Pendiente' },
            ];

            const tableBody = document.getElementById('orderTableBody');
            tableBody.innerHTML = '';

            orders.forEach((order, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${order.id}</td>
                    <td>${order.cliente}</td>
                    <td>${order.fecha}</td>
                    <td>${order.total}</td>
                    <td>${order.estado}</td>
                `;
                row.style.animation = `fadeIn 0.5s ease-in-out ${index * 0.1}s`;
                row.style.opacity = 0;
                tableBody.appendChild(row);
                setTimeout(() => {
                    row.style.opacity = 1;
                }, index * 100);
            });
        }

        loadOrders(); // Carga inicial de pedidos

        // Añadir efecto hover a las filas de la tabla
        document.addEventListener('mouseover', function(event) {
            if (event.target.tagName === 'TD') {
                event.target.parentElement.style.transition = 'background-color 0.3s ease';
                event.target.parentElement.style.backgroundColor = 'rgba(0, 123, 255, 0.1)';
            }
        }, true);

        document.addEventListener('mouseout', function(event) {
            if (event.target.tagName === 'TD') {
                event.target.parentElement.style.backgroundColor = '';
            }
        }, true);
    </script>
</body>
</html>



                    {{--
                    <div class="row mt-4">
                        <div class="col-md-3 mb-4">
                            <div class="card bg-primary text-white fade-in">
                                <div class="card-body">
                                    <h5 class="card-title">Usuarios</h5>
                                    <p id="userCount" class="card-text fs-2">150</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-success text-white fade-in" style="animation-delay: 0.2s;">
                                <div class="card-body">
                                    <h5 class="card-title">Productos</h5>
                                    <p id="productCount" class="card-text fs-2">75</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-warning text-dark fade-in" style="animation-delay: 0.4s;">
                                <div class="card-body">
                                    <h5 class="card-title">Ventas</h5>
                                    <p id="salesCount" class="card-text fs-2">$10,250</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card bg-info text-white fade-in" style="animation-delay: 0.6s;">
                                <div class="card-body">
                                    <h5 class="card-title">Pedidos</h5>
                                    <p id="orderCount" class="card-text fs-2">25</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tabla de últimos pedidos -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card slide-in">
                                <div class="card-body">
                                    <h5 class="card-title">Últimos Pedidos</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Cliente</th>
                                                    <th>Fecha</th>
                                                    <th>Total</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody id="orderTableBody">
                                                <!-- Los datos se cargarán dinámicamente aquí -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}