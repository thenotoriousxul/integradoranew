<aside id="sidebar" class="bg-light border-start p-4 sidebar-container">
    <div class="mb-4">Hola !! {{ Auth::user()->name }}</div>
    <nav class="nav flex-column mb-4">
        <a href="{{ url('/') }}" class="nav-link text-secondary py-2">Tienda</a>
        <a href="{{ route('pedidos') }}" class="nav-link text-secondary py-2">Mis compras</a>
        <a href="{{ route('perfil') }}" class="nav-link text-secondary py-2">Datos personales</a>
        <a href="{{ route('envios.pendientes') }}" class="nav-link text-secondary py-2">Envios pendientes</a>
        <a href="#" class="nav-link text-secondary py-2">Atención al cliente</a>
    </nav>
    <a class="btn btn-dark w-100 py-3 rounded-3" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Cerrar sesion') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</aside>

<style>
    .nav-link:hover {
        color: #000 !important;
    }
    .btn-dark:hover {
        background-color: #333;
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

