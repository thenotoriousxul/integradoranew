@extends('cliente.layouts.dashboard')

@section('content')

<style>

        .main-container {
            padding: 2rem;
            min-width: 900px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: #000;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .gender-options {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            flex: 1;
        }

        .phone-group {
            display: flex;
            gap: 0.5rem;
        }

        .prefix {
            width: 80px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="date"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e2e2;
            border-radius: 4px;
            background-color: #f6f6f6;
        }
</style>

<div class="main-container">
    <header class="header">
        <a href="#" class="logo">OZEZ</a>
    </header>

 
        <section class="form-section">
            <h2 class="section-title">Datos personales</h2>
            

            <div class="form-row">
                <div class="form-group">
                    <input type="text" placeholder="Nombre *" required>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Apellidos *" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="date" placeholder="Fecha de Nacimiento *" required>
                </div>
                <div class="form-group phone-group">
                    <input type="tel" placeholder="Teléfono móvil *" required>
                </div>
            </div>
        </section>
        <form>
        <section class="form-section">
            <h2 class="section-title">Dirección</h2>
            
            <div class="form-row">
                <div class="form-group">
                    <input type="text" placeholder="Dirección *" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" placeholder="Más información (Opcional)">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" placeholder="Código postal *" required>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Municipio *" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" placeholder="Ciudad *" required>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Colonia *" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" placeholder="Estado *" required>
                </div>
                <div class="form-group">
                    <input type="text" value="Mexico" readonly>
                </div>
            </div>
        </section>
    </form>
</div>
@endsection
