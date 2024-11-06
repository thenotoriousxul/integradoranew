@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Carrito de Compras</h1>
    
    <!-- Contenedor del Carrito -->
    <div id="carrito-container" class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="carrito-body">
                <!-- Los productos se cargarán aquí dinámicamente -->
            </tbody>
        </table>
    </div>
    
    <!-- Resumen del Carrito -->
    <div class="text-end mt-4">
        <h4>Total del Carrito: $<span id="carrito-total">0.00</span></h4>
        <button id="vaciar-carrito" class="btn btn-danger mt-3">Vaciar Carrito</button>
        <button id="comprar-carrito" class="btn btn-success mt-3">Proceder al Pago</button>
    </div>
</div>

<!-- Script para la Funcionalidad del Carrito -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        cargarCarrito();

        document.getElementById("vaciar-carrito").addEventListener("click", vaciarCarrito);
        document.getElementById("comprar-carrito").addEventListener("click", comprarCarrito);
    });

    // Función para cargar el carrito desde localStorage
    function cargarCarrito() {
        const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        const carritoBody = document.getElementById("carrito-body");
        let total = 0;

        carritoBody.innerHTML = ""; // Limpiar el contenido previo

        carrito.forEach((producto, index) => {
            const subtotal = producto.precio * producto.cantidad;
            total += subtotal;

            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${producto.nombre}</td>
                <td>$${producto.precio.toFixed(2)}</td>
                <td>
                    <input type="number" class="form-control cantidad" data-index="${index}" value="${producto.cantidad}" min="1">
                </td>
                <td>$${subtotal.toFixed(2)}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="eliminarProducto(${index})">Eliminar</button>
                </td>
            `;
            carritoBody.appendChild(row);
        });

        document.getElementById("carrito-total").innerText = total.toFixed(2);

        // Actualizar cantidad al cambiar el valor
        document.querySelectorAll(".cantidad").forEach(input => {
            input.addEventListener("change", actualizarCantidad);
        });
    }

    // Función para actualizar la cantidad de un producto
    function actualizarCantidad(event) {
        const index = event.target.getAttribute("data-index");
        const nuevaCantidad = parseInt(event.target.value);
        
        const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        carrito[index].cantidad = nuevaCantidad;

        localStorage.setItem("carrito", JSON.stringify(carrito));
        cargarCarrito();
    }

    // Función para eliminar un producto del carrito
    function eliminarProducto(index) {
        const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        carrito.splice(index, 1);

        localStorage.setItem("carrito", JSON.stringify(carrito));
        cargarCarrito();
    }

    // Función para vaciar el carrito
    function vaciarCarrito() {
        localStorage.removeItem("carrito");
        cargarCarrito();
    }

    // Función para simular la compra
    function comprarCarrito() {
        alert("Gracias por tu compra.");
        vaciarCarrito();
    }
</script>
@endsection
