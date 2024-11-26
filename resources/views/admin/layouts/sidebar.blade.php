<style>
    .sidebar-container {
        background-color: #1f2937;
        width: 250px;
        padding: 25px;
        height: 100vh;
        position: fixed;
        transition: all 0.4s ease-in-out;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 3px 0 15px rgba(0, 0, 0, 0.5);
        border-right: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 0 10px 10px 0;
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
        box-shadow: 0px 4px 10px rgba(107, 91, 255, 0.5);
        transition: transform 0.3s ease;
    }
    .logo img:hover {
        transform: scale(1.05);
    }
    .page-container {
        margin-bottom: 35px;
    }
    .title-section {
        color: #7c3aed;
        margin-bottom: 15px;
        font-size: 15px;
        font-weight: lighter;
        text-transform: uppercase;
        letter-spacing: 1.2px;
    }
    .item-side {
        display: flex;
        align-items: center;
        padding: 8px 13px;
        text-decoration: none;
        color: white;
        font-size: 15px;
        border-radius: 12px;
        margin-bottom: 15px;
        background-color: transparent;
        transition: background-color 0.4s ease, transform 0.3s ease, box-shadow 0.4s ease;
        position: relative;
    }
    .item-side:hover {
        background-color: #374151;
        box-shadow: 0 10px 20px rgba(107, 91, 255, 0.6);
        transform: translateX(10px);
        color: white;
        text-decoration: none;
    }
    .item-side i {
        margin-right: 15px;
        font-size: 22px;
        color: #7c3aed;
        transition: color 0.3s ease;
    }
    .item-side:hover i {
        color: #9f7aea;
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
        background-color: #7c3aed;
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
                <i class="fas fa-home"></i>
                <span class="sidebar-text">Menú principal</span>
            </a>
        </div>
        <div class="page-container">
            <h3 class="title-section">Administración</h3>
            <a id="inventario-item" class="item-side" href="">
                <i class="fas fa-box"></i>
                <span class="sidebar-text">Productos</span>
                <i class="fas fa-chevron-down abajo"></i>
            </a>
            <div id="inventario-submenu" class="submenu">
                {{-- ////////////////// --}}
                <a class="item-side sub" href="{{ route('crear.producto') }}">
                    <i class="fas fa-plus"></i>
                    <span class="sidebar-text">Crear producto catalogo</span>
                </a>
                <a class="item-side sub" href="{{ route('dash.productosBase') }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span class="sidebar-text">Lista Productos Base</span>
                </a>
                <a class="item-side sub" href="{{ route('agregar.producto') }}">
                    <i class="fas fa-plus"></i>
                    <span class="sidebar-text">Agregar Producto Base</span>
                </a>
            </div>
            <a id="ediciones" class="item-side" href="">
                <i class="fas fa-box"></i>
                <span class="sidebar-text">Ediciones</span>
                <i class="fas fa-chevron-down abajo"></i>
            </a>
            <div id="ediciones-submenu" class="submenu">
                <a class="item-side sub" href="{{ route('ediciones.listar') }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span class="sidebar-text">Lista Ediciones</span>
                </a>
                <a class="item-side sub" href="{{ route('ediciones.crear') }}">
                    <i class="fas fa-plus"></i>
                    <span class="sidebar-text">Crear Edición</span>
                </a>
            </div>


            <a id="estampados" class="item-side" href="">
                <i class="fas fa-box"></i>
                <span class="sidebar-text">Estampados</span>
                <i class="fas fa-chevron-down abajo"></i>
            </a>
            <div id="estampados-submenu" class="submenu">
                <a class="item-side sub" href="{{ route('estampados.listar') }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span class="sidebar-text">Lista Estampados</span>
                </a>
                <a class="item-side sub" href="{{ route('crear.diseño') }}">
                    <i class="fas fa-plus"></i>
                    <span class="sidebar-text">Agregar diseño</span>
                </a>
                <a class="item-side sub" href="{{ route('estampados.crear') }}">
                    <i class="fas fa-plus"></i>
                    <span class="sidebar-text">Agregar Estampado</span>
                </a>
            </div>


            <a class="item-side" href="/dash/gestor/historial">
                <i class="fas fa-history"></i>
                <span class="sidebar-text">Historial</span>
            </a>
        </div>
        <div class="page-container">
            <h3 class="title-section">Órdenes</h3>
            <a class="item-side" href="{{ route('admins.ordenes.index') }}">
                <i class="fas fa-list"></i>
                <span class="sidebar-text">Lista de Órdenes</span>
            </a>
            <a class="item-side" href="{{ route('admins.ordenes.create') }}">
                <i class="fas fa-plus"></i>
                <span class="sidebar-text">Crear Orden</span>
            </a>
        </div>
        <div class="page-container">
            <h3 class="title-section">Configuración</h3>
            <a id="configuracion" class="item-side" href="">
                <i class="fas fa-cogs"></i>
                <span class="sidebar-text">Ajustes</span>
                <i class="fas fa-chevron-down abajo"></i>
            </a>
            <div id="configuracion-submenu" class="submenu">
                <a class="item-side sub" href="">
                    <i class="fas fa-list"></i>
                    <span class="sidebar-text">Ver Usuarios</span>
                </a>
                <a class="item-side sub" href="">
                    <i class="fas fa-plus"></i>
                    <span class="sidebar-text">Agregar Usuario</span>
                </a>
                <a class="item-side sub" href="{{route('manual')}}">
                    <i class="fas fa-plus"></i>
                    <span class="sidebar-text">Ayuda</span>
                </a>
            </div>
        </div>
        {{------------------------------- --}}
    </div>
</aside>
