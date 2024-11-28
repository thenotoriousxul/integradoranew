<style>
    .sidebar {
            width: 400px;
            padding: 2rem;
            border-left: 1px solid #e2e2e2;
            background-color: #f9f9f9;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            text-decoration: none;
            color: #666;
        }

        .menu-item:hover {
            color: #000;
        }

        .logout-button {
            display: block;
            width: 100%;
            padding: 1rem;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 2rem;
            text-decoration: none;
        
        }

        .logout-button:hover {
            background-color: #333;
        }
        .menu-item i {
            width: 20px;
            margin-right: 10px;
        }
        .sidecont { 
            display: flex; 
            justify-content: flex-end; 
            height: 100vh; 
             }
</style>
<div class="sidecont">
    <aside class="sidebar">
        <div>Hola !!</div>
        <nav>
            <a href="{{ url('/') }}" class="menu-item">Tienda</a>
            <a href="{{ route('pedidos') }}" class="menu-item">Mis compras</a>
            <a href="{{ route('perfil') }}" class="menu-item">Datos personales</a>
            <a href="#" class="menu-item">Atención al cliente</a>
        </nav>
        <a class="logout-button" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Cerrar sesion') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
       </form>
    </aside>
</div>
