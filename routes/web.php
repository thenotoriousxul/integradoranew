<?php

use App\Http\Controllers\formularios\formularioProveedor;
use App\Http\Controllers\formularios\formularioProducto;
use App\Http\Controllers\productoController;
use App\Http\Controllers\proveedorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

 Route::get('/productos', function () {
     return view('productos');
 })->name('productos');

Route::get('/producto', function () {
    return view('producto_detalle');
})->name('producto.detalle');

Route::get('/carrito', function () {
    return view('carrito'); 
})->name('carrito');

Route::get('/pago', function () {
    return view('pago');
})->name('pago');

Route::get('/perfil', function () {
    return view('perfil'); 
})->name('perfil')->middleware('auth');


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');

Route::get('/cliente/dashboard', function () {
    return view('cliente.dashboard');
})->name('cliente.dashboard')->middleware('auth');

Route::get('/rebajas', function () {
    return view('rebajas');
})->name('rebajas');


Route::get('/envios', function () {
    return view('envios');
})->name('envios');


//------------------------------------------
Route::get('/formulario/agregar/Producto', [formularioProducto::class, 'formularioProducto'])->name('agregar.producto');


//Productos---------------------------------------------------
Route::get('/productos/base',[productoController::class, 'getProductos'])->name('mostrar.productos');
//guardar producto
Route::Post('/agregar/producto',[productoController::class, 'saveProducto'])->name('producto.save');

//------------------------------------------


//Crear provedor-------------------------------------------------

Route::get('/agregar/proveedor',[formularioProveedor::class, 'agregarProveedor'])->name('agregar.proveedor');
Route::get('/guardar/proveedor', [proveedorController::class, 'saveProveedor'])->name('guardar.proveedor');
//--------------------------------------------------------------