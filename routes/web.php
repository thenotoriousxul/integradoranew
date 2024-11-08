<?php

use App\Http\Controllers\formularioProducto;
use App\Http\Controllers\productoController;
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

Route::Post('/agregar/producto',[productoController::class, 'saveProducto'])->name('producto.save');


//------------------------------------------