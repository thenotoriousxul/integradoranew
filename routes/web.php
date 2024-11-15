<?php
use App\Http\Controllers\carritoController;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;
use App\Http\Controllers\formularios\formulariosController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\proveedorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EdicionController;
use App\Http\Controllers\EstampadoController;


// Rutas de acceso general
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/catalogo', function () {
    return view('catalogo');
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
})->name('perfil');

// Rutas protegidas para administrador y cliente
Route::middleware(['auth'])->group(function () {
    // Dashboard del administrador, restringido solo para usuarios con rol 'admin'
    Route::get('/admin/dashboard', function () {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'No tienes acceso a esta página.');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Dashboard del cliente, restringido solo para usuarios con rol 'cliente'
    Route::get('/formulario/agregar/Producto', [formulariosController::class, 'formularioProducto'])->name('agregar.producto');
    Route::get('/productos/base', [productoController::class, 'getProductos'])->name('mostrar.productos');
    Route::post('/agregar/producto', [productoController::class, 'saveProducto'])->name('producto.save');

    Route::get('/agregar/proveedor', [formulariosController::class, 'agregarProveedor'])->name('agregar.proveedor');
    Route::get('/guardar/proveedor', [proveedorController::class, 'saveProveedor'])->name('guardar.proveedor');
});




// Rutas específicas para clientes usando el middleware directamente
Route::middleware(['auth'])->group(function () {
    Route::get('/cliente/dashboard', function () {
        if (!auth()->user()->hasRole('cliente')) {
            abort(403, 'No tienes acceso a esta página.');
        }
        return view('cliente.dashboard');
    })->name('cliente.dashboard');
});

// Rutas de acceso general
Route::get('/rebajas', function () {
    return view('rebajas');
})->name('rebajas');

Route::get('/envios', function () {
    return view('envios');
})->name('envios');

// Formularios y productos sin autenticación
Route::get('/productos/base', [productoController::class, 'getProductos'])->name('mostrar.productos');
Route::post('/agregar/producto', [productoController::class, 'saveProducto'])->name('producto.save');

// Rutas de proveedores sin autenticación
Route::get('/guardar/proveedor', [proveedorController::class, 'saveProveedor'])->name('guardar.proveedor');

// Crear edición sin autenticación

//Productos---------------------------------------------------
Route::get('/productos/base',[productoController::class, 'getProductos'])->name('mostrar.productos');
//guardar producto
Route::Post('/agregar/producto',[productoController::class, 'saveProducto'])->name('producto.save');


Route::get('/agregar/proveedor',[formulariosController::class, 'agregarProveedor'])->name('agregar.proveedor');
Route::get('/guardar/proveedor', [proveedorController::class, 'saveProveedor'])->name('guardar.proveedor');


Route::get('/agregar/edicion',[formulariosController::class,'formularioEdicion'])->name('agregar.edicion');

Route::get('/producto/{id}', action: [ProductoController::class, 'detalle'])->name('vista_producto_detalle');


// Rutas para gestionar el carrito
Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregarProducto'])->name('carrito.agregar');
Route::put('/carrito/actualizar/{id}', [CarritoController::class, 'actualizarCantidad'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminarProducto'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciarCarrito'])->name('carrito.vaciar');
Route::get('dash', function(){
return view('admin.layouts.dash');
});


Route::get('/dash/menu', function () {
    return view('admin.dashMenu');
})->name('dash.menu');


Route::get('/dashorden', function () {
    return view('admin.dashOrdenes');
});

Route::get('/dashinventario', function () {
    return view('admin.dashInventario');
});


Route::get('/dash/productosBase',[productoController::class, 'dashProductos'])->name('dash.productosBase');

Route::get('/mispedidos', function () {
    return view('mis-pedidos');
});


Route::get('/personalizacion', [PersonalizacionController::class, 'personalizacion']);

Route::prefix('admin/ediciones')->group(function () {
    Route::get('/crear', [EdicionController::class, 'crearFormularioEdicion'])->name('ediciones.crear');
    Route::post('/guardar', [EdicionController::class, 'guardarEdicion'])->name('ediciones.guardar');
    Route::get('/listar', [EdicionController::class, 'listarEdiciones'])->name('ediciones.listar');
    Route::get('/{id}/detalle', [EdicionController::class, 'detalleEdicion'])->name('ediciones.detalle');
    Route::get('/{id}/editar', [EdicionController::class, 'editarFormularioEdicion'])->name('ediciones.editar');
    Route::post('/{id}/actualizar', [EdicionController::class, 'actualizarEdicion'])->name('ediciones.actualizar');
    Route::delete('/{id}/eliminar', [EdicionController::class, 'eliminarEdicion'])->name('ediciones.eliminar');
});

Route::prefix('admin/estampados')->group(function () {
    Route::get('/listar', [EstampadoController::class, 'listarEstampados'])->name('estampados.listar');
    Route::get('/crear', [EstampadoController::class, 'crearFormularioEstampado'])->name('estampados.crear');
    Route::post('/guardar', [EstampadoController::class, 'guardarEstampado'])->name('estampados.guardar');
    Route::get('/{id}/editar', [EstampadoController::class, 'editarFormularioEstampado'])->name('estampados.editar');
    Route::post('/{id}/actualizar', [EstampadoController::class, 'actualizarEstampado'])->name('estampados.actualizar');
    Route::delete('/{id}/eliminar', [EstampadoController::class, 'eliminarEstampado'])->name('estampados.eliminar');
});
