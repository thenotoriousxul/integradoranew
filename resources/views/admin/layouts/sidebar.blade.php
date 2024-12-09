<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
    * {
    font-family: 'Inter', sans-serif; /* Aplica Inter a todo el documento */
    }
    .sidebar-container {
        background-color: #ffff;
        width: 250px;
        padding: 25px;
        height: 100vh;
        position: fixed;
        transition: all 0.4s ease-in-out;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 3px 0 15px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
    }
    .sidebar-container.hidden {
        transform: translateX(-280px);
    }
    .logo-container {
        text-align: center;
        margin-bottom: 30px;
        flex-shrink: 0;
    }
    .logo img {
        max-width: 90%;
        max-height: 80px;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }
    .logo img:hover {
        transform: scale(1.05);
    }
    .page-container {
        margin-bottom: 35px;
    }
    .title-section {
        color: black;
        margin-bottom: 15px;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1.2px;
    }
    .item-side {
        display: flex;
        align-items: center;
        padding: 8px 13px;
        text-decoration: none;
        color: royalblue;
        font-size: 17px;
        border-radius: 12px;
        margin-bottom: 15px;
        background-color: transparent;
        transition: background-color 0.4s ease, transform 0.3s ease, box-shadow 0.4s ease;
        position: relative;
    }
    .item-side:hover {
        transform: translateX(10px);
        color: darkblue;
        text-decoration: none;
    }
    .item-side i {
        margin-right: 15px;
        font-size: 22px;
        color:dodgerblue;
        transition: color 0.3s ease;
    }
    .item-side:hover i {
        color: darkblue;
    }
    .item-side .sidebar-text {
        display: inline-block;
        opacity: 1;
        transition: opacity 0.3s ease-in-out;
    }
    .item-side:after {
        content: "";
        position: absolute;
        height: 100%;
        width: 5px;
        background-color: darkblue;
        left: 0;
        top: 0;
        border-radius: 0 4px 4px 0;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }
    .item-side:hover:after {
        opacity: 1;
    }
    .submenu {
        display: none;
        padding-left: 20px;
    }
    .abajo {
        margin-left: auto;
    }
    @media (max-width: 768px) {
        .sidebar-container {
            transform: translateX(-100%);
            width: 100%;
            max-width: 320px;
        }
        .sidebar-container.hidden {
            transform: translateX(-100%);
        }
        .sidebar-container.visible {
            transform: translateX(0);
        }
    }
</style>

<aside class="sidebar-container">
    <div class="logo-container">
        <a href="{{ route('home') }}">
            <p class="logo">
                <img src="{{ asset('img/ozeztrc.png') }}" alt="Logo" />
            </p>
        </a>
    </div>
    <div class="menu-container">
        <div class="page-container">
            <h3 class="title-section">Menú</h3>
            <a class="item-side" href="{{ route('dash.menu') }}">
                <i class="fas fa-tshirt"></i> <!-- Icono para tienda de ropa -->
                <span class="sidebar-text">Menú principal</span>
            </a>
        </div>
        <div class="page-container">
            <h3 class="title-section">Administración</h3>
            <a id="inventario-item" class="item-side" href="">
                <i class="fas fa-box-open"></i> <!-- Caja abierta (productos) -->
                <span class="sidebar-text">Productos</span>
                <i class="fas fa-chevron-down abajo"></i>
            </a>
            <div id="inventario-submenu" class="submenu">
                <a class="item-side sub" href="{{ route('crear.producto') }}">
                    <i class="fas fa-tshirt"></i> <!-- Icono de camiseta -->
                    <span class="sidebar-text">Crear producto catalogo</span>
                </a>

                <a class="item-side sub" href="{{ route('admin.ediciones_personalizadas.create') }}">
                    <i class="fas fa-pencil-alt"></i> <!-- Icono de lápiz para personalización -->
                    <span class="sidebar-text">Crear producto personalizado</span>
                </a>

                <a class="item-side sub" href="{{ route('listar.productos') }}">
                    <i class="fas fa-th-list"></i> <!-- Icono de lista -->
                    <span class="sidebar-text">Listar Producto Catalogo</span>
                </a>

                <a class="item-side sub" href="{{ route('agregar.producto') }}">
                    <i class="fas fa-plus-circle"></i> <!-- Icono de agregar producto -->
                    <span class="sidebar-text">Agregar Producto Base</span>
                </a>

                <a class="item-side sub" href="{{ route('dash.productosBase') }}">
                    <i class="fas fa-th-list"></i> <!-- Icono de lista -->
                    <span class="sidebar-text">Lista Productos Base</span>
                </a>
            </div>
            <a id="ediciones" class="item-side" href="">
                <i class="fas fa-pen"></i> <!-- Icono de edición -->
                <span class="sidebar-text">Ediciones</span>
                <i class="fas fa-chevron-down abajo"></i>
            </a>
            <div id="ediciones-submenu" class="submenu">
                <a class="item-side sub" href="{{ route('ediciones.listar') }}">
                    <i class="fas fa-th-list"></i> <!-- Icono de lista -->
                    <span class="sidebar-text">Lista Ediciones</span>
                </a>
                <a class="item-side sub" href="{{ route('ediciones.crear') }}">
                    <i class="fas fa-plus-circle"></i> <!-- Icono de agregar edición -->
                    <span class="sidebar-text">Crear Edición</span>
                </a>
            </div>

            <a id="estampados" class="item-side" href="">
                <i class="fas fa-print"></i> <!-- Icono de estampado -->
                <span class="sidebar-text">Estampados</span>
                <i class="fas fa-chevron-down abajo"></i>
            </a>
            <div id="estampados-submenu" class="submenu">
                <a class="item-side sub" href="{{ route('estampados.listar') }}">
                    <i class="fas fa-th-list"></i> <!-- Icono de lista -->
                    <span class="sidebar-text">Lista Estampados</span>
                </a>
                <a class="item-side sub" href="{{ route('crear.diseño') }}">
                    <i class="fas fa-paint-brush"></i> <!-- Icono de diseño -->
                    <span class="sidebar-text">Agregar diseño</span>
                </a>
                <a class="item-side sub" href="{{ route('estampados.crear') }}">
                    <i class="fas fa-paint-brush"></i> <!-- Icono de pintura -->
                    <span class="sidebar-text">Agregar Estampado</span>
                </a>
            </div>

            <a id="proveedores" class="item-side" href="">
                <i class="fas fa-truck"></i> <!-- Icono de proveedor (camión de entrega) -->
                <span class="sidebar-text">Proveedores</span>
                <i class="fas fa-chevron-down abajo"></i>
            </a>
            <div id="proveedores-submenu" class="submenu">
                <a class="item-side sub" href="{{ route('proveedores.index') }}">
                    <i class="fas fa-th-list"></i> <!-- Icono de lista -->
                    <span class="sidebar-text">Lista Proveedores</span>
                </a>
                <a class="item-side sub" href="{{ route('admin.agregarProveedor') }}">
                    <i class="fas fa-plus-circle"></i> <!-- Icono de agregar proveedor -->
                    <span class="sidebar-text">Agregar Proveedor</span>
                </a>
            </div>

            <a id="personalizadas" class="item-side" href="{{ route('admin.personalizar') }}">
                <i class="fas fa-cogs"></i> <!-- Icono de personalización -->
                <span class="sidebar-text">Personalizadas</span>
            </a>

            <a id="acciones" class="item-side" href="">
                <i class="fas fa-cogs"></i> <!-- Icono de configuración -->
                <span class="sidebar-text">Acciones</span>
                <i class="fas fa-chevron-down abajo"></i>
            </a>

            <div id="acciones-submenu" class="submenu">
                <a class="item-side sub" href="{{route('admin.auditoria.usuarios')}}">
                    <i class="fas fa-users"></i> <!-- Icono de usuarios -->
                    <span class="sidebar-text">Usuarios</span>
                </a>
                <a class="item-side sub" href="{{route('admin.auditoria.pagos')}}">
                    <i class="fas fa-credit-card"></i> <!-- Icono de pagos -->
                    <span class="sidebar-text">Pagos</span>
                </a>
                <a class="item-side sub" href="{{route('admin.auditoria.ediciones')}}">
                    <i class="fas fa-edit"></i> <!-- Icono de edición -->
                    <span class="sidebar-text">Ediciones</span>
                </a>
            </div>
        </div>

        <div class="page-container">
            <h3 class="title-section">Órdenes</h3>
            <a class="item-side" href="{{ route('admins.ordenes.index') }}">
                <i class="fas fa-box"></i> <!-- Caja (orden) -->
                <span class="sidebar-text">Lista de Órdenes</span>
            </a>
            <a class="item-side" href="{{ route('admins.ordenes.create') }}">
                <i class="fas fa-plus-circle"></i> <!-- Icono de agregar orden -->
                <span class="sidebar-text">Crear Orden</span>
            </a>
            <a id="Reporte" class="item-side" href="{{ route('admin.reporteVentas') }}">
                <i class="fas fa-chart-line"></i> <!-- Icono de reporte (gráfico) -->
                <span class="sidebar-text">Reporte Ventas</span>
            </a>
        </div>

        @if (Auth::user()->hasRole('admin'))
        <div class="page-container">
            <h3 class="title-section">Configuración</h3>
            <a id="configuracion" class="item-side" href="">
                <i class="fas fa-cogs"></i> <!-- Icono de configuración -->
                <span class="sidebar-text">Ajustes</span>
                <i class="fas fa-chevron-down abajo"></i>
            </a>
            <div id="configuracion-submenu" class="submenu">
                <a class="item-side sub" href="{{route('listar.usurios')}}">
                    <i class="fas fa-users"></i> <!-- Icono de usuarios -->
                    <span class="sidebar-text">Ver Usuarios</span>
                </a>
                <a class="item-side sub" href="{{route('registrar.empleados')}}">
                    <i class="fas fa-user-plus"></i> <!-- Icono de agregar empleado -->
                    <span class="sidebar-text">Agregar empleado</span>
                </a>
                <a class="item-side sub" href="{{route('manual')}}">
                    <i class="fas fa-book"></i> <!-- Icono de manual -->
                    <span class="sidebar-text">Ayuda</span>
                </a>
            </div>
        </div>
        @endif
    </div>
</aside>
