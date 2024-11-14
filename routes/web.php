<?php
use App\Http\Controllers\carritoController;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;
use App\Http\Controllers\formularios\formulariosController;
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


//--------------------------------------------------------------------------


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

Route::get('/formulario/agregar/Producto', [formulariosController::class, 'formularioProducto'])->name('agregar.producto');

Route::get('/dashmenu', function () {
    return view('admin.dashMenu');
});

Route::get('/dashorden', function () {
    return view('admin.dashOrdenes');
});