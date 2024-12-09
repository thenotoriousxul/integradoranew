<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\carritoController;
use App\Http\Controllers\disenosController;
use App\Http\Controllers\informacionClienteController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\dashController;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;
use App\Http\Controllers\formularios\formulariosController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\proveedorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EdicionController;
use App\Http\Controllers\EdicionesProductoController;
use App\Http\Controllers\empleadoController;
use App\Http\Controllers\EstampadoController;
use App\Http\Controllers\PersonalizarController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PruebaController;
use App\Mail\ordenMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\EdicionPersonalizadaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;  
use Illuminate\Support\Facades\Response;  
use App\Http\Controllers\S3ImageController;
use App\Http\Controllers\AuditoriaController;
use App\Mail\EnvioEntregado;
use App\Models\Envios;

//prueba
// Rutas de acceso general
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/catalogo', function () {
    return view('catalogo');
})->name('catalogo');


Route::get('/carrito', function () {
    return view('carrito'); 
})->name('carrito');


Route::get('/perfil', [informacionClienteController::class, 'dashinfo'])->name('perfil')->middleware('auth');


// Rutas específicas para clientes usando el middleware directamente
Route::middleware(['auth'])->group(function () {
    Route::get('/cliente/dashboard', function () {
        if (!auth()->user()->hasRole('cliente')) {
            abort(403, 'No tienes acceso a esta página.');
        }
        return view('cliente.dashboard');
    })->name('cliente.dashboard');

    
Route::post('/procesar-pago', [StripeController::class, 'procesarPago'])->name('procesarPago');
Route::post('/create-payment-intent', [StripeController::class, 'createPaymentIntent'])->name('createPaymentIntent');



Route::get('/agradecimiento', function () {
    return view('agradecimitnto');
})->name('agradecimiento');




Route::get('/pago', function () {
    return view('pago');
})->name('pago');



Route::get('/Datos/Cliente', function () {
    return view('informacionCliente');
})->name('informacionCliente');



Route::get('/Detalle_Orden', [informacionClienteController::class, 'mostrarInformacionEnvio'])->name('detalleOrden')->middleware('auth');

});

Route::get('/envios', function () {
    return view('envios');
})->name('envios');


// Rutas para gestionar el carrito
Route::get('/carrito', [carritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
Route::post('/carrito/agregar/{id}', [carritoController::class, 'agregarProducto'])->name('carrito.agregar');
Route::put('/carrito/actualizar/{id}', [carritoController::class, 'actualizarCantidad'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{id}', [carritoController::class, 'eliminarProducto'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [carritoController::class, 'vaciarCarrito'])->name('carrito.vaciar');



Route::get('dash', function(){
return view('admin.layouts.dash');
});

Route::get('/dashorden', function () {
    return view('admin.dashOrdenes');
});

Route::get('/dashinventario', function () {
    return view('admin.dashInventario');
});

Route::get('/pedidos', [OrdenController::class, 'listarPedidos'])->name('pedidos');

Route::get('/productos/catalogo',[EdicionesProductoController::class, 'getProductos'])->name('mostrar.productos');
Route::get('/filtros',[EdicionesProductoController::class, 'filtro'])->name('filtros.productos');

Route::get('/producto/{id}', action: [EdicionesProductoController::class, 'detalle'])->name('vista_producto_detalle'); 

Route::get('/personalizacion', [PersonalizarController::class, 'mostrarCatalogoPersonalizableFinal'])->name('personalizacion');

Route::get('/personalizacion/{id}', [PersonalizarController::class, 'mostrarDetalle'])->name('personalizacion.detalle');


Route::get('/dash/cliente', function () {
    return view('cliente.pedidos');
});




// rutas exlusivas del administrrador
Route::middleware(['role:admin'])->group(function(){
    Route::prefix('admin/empleado')->group(function(){
        Route::get('registrar', function(){ return view('auth.register-empleado');})->name('registrar.empleados');
        Route::post('guardar/empleado', [empleadoController::class, 'registrarEmpleado'])->name('guardar.empleado');  
    });

    Route::prefix('admin/usuarios')->group(function () {
        Route::get('/listar', [UserController::class, 'listar'])->name('listar.usurios');  
        Route::patch('/desactivar/{id}', [UserController::class, 'desactivar'])->name('desactivar.usuarios');  
        Route::patch('/activar/{id}', [UserController::class, 'activar'])->name('activar.usuarios');  
    });
});

Route::get('/rebajas' , [EdicionesProductoController::class, 'rebajas'])->name('rebajas');
Route::get('rebaja/filtro', [EdicionesProductoController::class, 'filtroRebaja'])->name('filtros.rebajas');

Route::middleware(['role:admin|empleado'])->group(function () {
    Route::get('/auditoria/ediciones', [AuditoriaController::class, 'audEdiciones'])->name('admin.auditoria.ediciones');
    Route::get('/auditoria/pagos', [AuditoriaController::class, 'audPagos'])->name('admin.auditoria.pagos');
    Route::get('/auditoria/usuarios', [AuditoriaController::class, 'audUsuarios'])->name('admin.auditoria.usuarios');

    Route::get('/proveedores', [proveedorController::class, 'index'])->name('proveedores.index');




    Route::prefix('admin/diseños')->group(function(){
        Route::get('/crear',[formulariosController::class, 'crearDiseño'])->name('crear.diseño');
        Route::post('/guardar',[disenosController::class, 'storeDiseños'])->name('guardar.diseño');
        Route::get('/diseños',[disenosController::class, 'getDiseños'])->name('mostrar.diseños');

    
    });

    
    Route::get('/agregar/proveedor',[formulariosController::class, 'agregarProveedor'])->name('agregar.proveedor');
    Route::get('/guardar/proveedor', [proveedorController::class, 'saveProveedor'])->name('guardar.proveedor');


    Route::prefix('admin/ediciones')->group(function () {
        Route::get('/crear', [EdicionController::class, 'crearFormularioEdicion'])->name('ediciones.crear');
        Route::get('/agregar/edicion',[formulariosController::class,'formularioEdicion'])->name('agregar.edicion');
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

    //// 

    Route::prefix('admin/producto')->group(function(){
        Route::get('/dash/productosBase', [productoController::class, 'dashProductos'])->name('dash.productosBase');
        Route::get('/formulario/agregar/Producto', [formulariosController::class, 'formularioProducto'])->name('agregar.producto');
        Route::post('/agregar/producto', [productoController::class, 'saveProducto'])->name('producto.save');
        Route::patch('/dash/productoBase/activar/{id}', [productoController::class, 'activar'])->name('activar.producto');
        Route::patch('/dash/productoBase/inactivar/{id}', [productoController::class, 'inactivar'])->name('inactivar.producto');
        Route::get('dash/producto/editar/{id}', [productoController::class, 'editar'])->name('editar.producto.base');
        Route::put('dash/productos/actualizar/{id}', [productoController::class, 'update'])->name('actualizar.producto.base');
        Route::get('dash/productos/filtroPorPrecio',[productoController::class, 'filtrarPorPrecio'])->name('filtrar.precio');
        Route::get('dash/productos/filtros',[productoController::class, 'filtros'])->name('filtros');
    });


    Route::prefix('admins/ordenes')->group(function () {
        Route::get('/', [OrdenController::class, 'index'])->name('admins.ordenes.index');
        Route::get('/crear', [OrdenController::class, 'create'])->name('admins.ordenes.create');
        Route::post('/guardar', [OrdenController::class, 'store'])->name('admins.ordenes.store');
        Route::get('/{id}/editar', [OrdenController::class, 'edit'])->name('admins.ordenes.edit');
        Route::put('/{id}/actualizar', [OrdenController::class, 'update'])->name('admins.ordenes.update');
        Route::delete('/{id}/eliminar', [OrdenController::class, 'destroy'])->name('admins.ordenes.destroy');
        Route::get('/{id}', [OrdenController::class, 'show'])->name('admins.ordenes.show');
        Route::patch('entregada/{id}', [OrdenController::class, 'Entregada'])->name('admin.orden.entregada');
        Route::patch('cancelada/{id}', [OrdenController::class, 'Cancelada'])->name('admin.orden.cancelada');
        Route::get('pendientes/{estado}', [OrdenController::class, 'filtroPendientes'])->name('admin.orden.pendientes');
        Route::get('filtrar/fecha', [OrdenController::class, 'filtrarFechas'])->name('admins.ordenes.filtrar');
    });


    Route::prefix('admin/ediciones_productos')->group(function(){
        Route::get('/crear/producto',[EdicionesProductoController::class, 'create'])->name('crear.producto');
        Route::post('guardar/producto',[EdicionesProductoController::class, 'store'])->name('store.productos');
        Route::patch('activar/producto/{id}',[EdicionesProductoController::class, 'activar'])->name('activar');
        Route::patch('inactivar/producto/{id}',[EdicionesProductoController::class, 'inactivar'])->name('inactivar');
        Route::get('listar',[EdicionesProductoController::class, 'getProducts'])->name('listar.productos');
        Route::patch('/actualizar/{id}', [EdicionesProductoController::class, 'update'])->name('actualizar.producto');
        Route::post('admin/ediciones_productos/guardar/producto/{id}', [EdicionesProductoController::class, 'update'])->name('store.productos.update');

    });
  
    Route::get('/admin/dashboard/menu', [dashController::class, 'menuPrincipal'])->name('dash.menu');
    Route::get('/admin/dashboard/manual', [dashController::class, 'manual'])->name('manual');
});


Route::middleware(['auth'])->group(function () {
    // Dashboard del administrador, restringido solo para usuarios con rol 'admin'
    Route::get('/admin/dashboard', function () {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'No tienes acceso a esta página.');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

});

Route::get('test', function(){
return view('mail.orden');
});



Route::get('/reporteAdmin', [dashController::class, 'reporteVentas'])->name('admin.reporteVentas');

Route::get('/pdf/reporte', [dashController::class, 'pdfReporteVentas'])->name('pdf.reporte');

Route::get('/agregarProveedor', function () {
    return view('admin.proveedores.agregarProveedor');
})->name('admin.agregarProveedor');




Route::put('/direccion/actualizar/{id}', [informacionClienteController::class, 'actualizarDireccion'])->name('direccion.actualizar');

Route::get('/envios-pendientes', [informacionClienteController::class, 'mostrarenvios'])->name('envios.pendientes');

Route::get('/envios-detalles/{id}', [informacionClienteController::class, 'obtenerDetallesProducto'])->name('envios.detallesProducto');



Route::prefix('admin/ediciones_personalizadas')->name('admin.ediciones_personalizadas.')->group(function () {
    Route::get('/crear', [EdicionPersonalizadaController::class, 'create'])->name('create');
    Route::post('/crear', [EdicionPersonalizadaController::class, 'store'])->name('store');
});
Route::post('/proveedor/nuevo', [proveedorController::class, 'nuevoproveedor'])->name('nuevoproveedor');


Route::get('/editar/{id}', [EdicionesProductoController::class, 'edit'])->name('editar.producto');
Route::patch('/actualizar/{id}', [EdicionesProductoController::class, 'update'])->name('actualizar.producto');





















Route::post('/carrito/agregar/{productoId}', [EdicionPersonalizadaController::class, 'agregarAlCarrito'])->name('carrito.agregar.personalizada');


Route::get('/admin/acciones', [AuditoriaController::class, 'index'])->name('admin.acciones');



Route::get('/personalizarAdmin', [PersonalizarController::class, 'mostrarCatalogoPersonalizable'])->name('admin.personalizar');


Route::get('/personalizarAdmin/{id}', [PersonalizarController::class, 'personalizarProducto'])->name('admin.guardar');


Route::get('/s3-image', [S3ImageController::class, 'getImage'])->name('s3.image');
Route::post('/producto/verificar', [StripeController::class, 'verificarProductos'])->name('producto.verificar');


Route::get('/auditoria/ediciones', [AuditoriaController::class, 'audEdiciones'])->name('admin.auditoria.ediciones');
Route::get('/auditoria/pagos', [AuditoriaController::class, 'audPagos'])->name('admin.auditoria.pagos');
Route::get('/auditoria/usuarios', [AuditoriaController::class, 'audUsuarios'])->name('admin.auditoria.usuarios');

Route::get('/proveedores/{id}/editar', [ProveedorController::class, 'editarProveedor'])->name('admin.editarProveedor');
Route::put('/proveedores/{id}', [ProveedorController::class, 'actualizarProveedor'])->name('admin.actualizarProveedor');
