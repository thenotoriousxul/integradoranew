<?php
use App\Http\Controllers\carritoController;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;
use App\Http\Controllers\formularios\formularioEdicion;
use App\Http\Controllers\formularios\formularioProveedor;
use App\Http\Controllers\formularios\formularioProducto;
use App\Http\Controllers\productoController;
use App\Http\Controllers\proveedorController;
use Illuminate\Support\Facades\Route;


// Rutas de acceso general
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

// Rutas específicas para administradores usando el middleware directamente
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        if (!auth()->User()->hasRole('admin')) {
            abort(403, 'No tienes acceso a esta página.');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/formulario/agregar/Producto', [formularioProducto::class, 'formularioProducto'])->name('agregar.producto');
    Route::get('/productos/base', [productoController::class, 'getProductos'])->name('mostrar.productos');
    Route::post('/agregar/producto', [productoController::class, 'saveProducto'])->name('producto.save');

    Route::get('/agregar/proveedor', [formularioProveedor::class, 'agregarProveedor'])->name('agregar.proveedor');
    Route::get('/guardar/proveedor', [proveedorController::class, 'saveProveedor'])->name('guardar.proveedor');
});

// Rutas específicas para clientes usando el middleware directamente
Route::middleware(['auth'])->group(function () {
    Route::get('/cliente/dashboard', function () {
        if (!auth()->User()->hasRole('cliente')) {
            abort(403, 'No tienes acceso a esta página.');
        }
        return view('cliente.dashboard');
    })->name('cliente.dashboard');

// Rutas de acceso general
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


//Crear edicion--------------------------------------------------------------
Route::get('/agregar/edicion',[formularioEdicion::class,'formularioEdicion'])->name('agregar.edicion');


//--------------------------------------------------------------------------
});

Route::get('/producto/{id}', action: [ProductoController::class, 'detalle'])->name('vista_producto_detalle');




// Rutas para gestionar el carrito
Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregarProducto'])->name('carrito.agregar');
Route::put('/carrito/actualizar/{id}', [CarritoController::class, 'actualizarCantidad'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminarProducto'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciarCarrito'])->name('carrito.vaciar');
