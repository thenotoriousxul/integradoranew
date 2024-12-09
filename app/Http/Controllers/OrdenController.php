<?php
namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\DetalleOrden;
use App\Models\Edicion;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\EdicionesProductos;
use App\Models\TipoPersona;
use Illuminate\Pagination\LengthAwarePaginator;

class OrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::with('tipoPersona.persona')->paginate(5);

        return view('admin.ordenes.index', compact('ordenes'));
    }



    public function filtroPendientes(Request $request, $estado)
    {
        // Obtener las órdenes usando Eloquent y cargar las relaciones necesarias
        $ordenes = Orden::with('tipoPersona.persona') // Cargar las relaciones necesarias
            ->where('estado', $estado) // Filtrar por estado
            ->paginate(5); // Paginación
    
        return view('admin.ordenes.index', compact('ordenes'));
    }


    
    public function filtrarFechas(Request $request)
    {
        // Validación de fechas
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
    
       
        $ordenes = Orden::with('tipoPersona.persona')
                        ->whereBetween('fecha_orden', [$request->fecha_inicio, $request->fecha_fin])
                        ->paginate(5);
    
        // Retornar la vista con las órdenes filtradas
        return view('admin.ordenes.index', compact('ordenes'));
    }

    

    public function create()
    {
        $productos = EdicionesProductos::where('estado', 'activo')->get();
        $tiposPersonas = TipoPersona::whereIn('tipo_persona', ['empleado', 'admin'])
            ->with('persona')
            ->get();
        
        return view('admin.ordenes.create', compact('productos', 'tiposPersonas'));
    }
    
    


    public function store(Request $request)
    {   
   
    $tipoPersonaId = 1;

    
    $request->validate([
        'total' => 'required|numeric|min:0',
        'envios_domicilio' => 'required|boolean',
        'productos' => 'required|array', 
        'productos.*' => 'required|integer|exists:ediciones_productos,id', 
        'cantidades' => 'required|array',
        'cantidades.*' => 'required|integer|min:1', 
        'precios' => 'required|array',
        'precios.*' => 'required|numeric|min:0', 
    ]);

    
    $orden = Orden::create([
        'tipo_personas_id' => $tipoPersonaId, 
        'fecha_orden' => now(),
        'total' => $request->total, 
        'envios_domicilio' => $request->envios_domicilio,
        'estado' => 'Pagada',
    ]);

    
    $productos = $request->productos;
    $cantidades = $request->cantidades;
    $precios = $request->precios;

   
    foreach ($productos as $index => $productoId) {
        $subtotal = $cantidades[$index] * $precios[$index]; 

       
        DetalleOrden::create([
            'ordenes_id' => $orden->id,
            'ediciones_productos_id' => $productoId,
            'cantidad' => $cantidades[$index],
            'total' => $subtotal,
        ]);
    }

   
    return redirect()->route('admins.ordenes.index')->with('success', 'Orden registrada correctamente.');
    }


    public function show($id)
    {
        $orden = Orden::with('detalles.EdicionProducto', 'tipoPersona.persona')->findOrFail($id);
       
        return view('admin.ordenes.show', compact('orden'));

    }

    public function Entregada($id){
        $orden = Orden::findOrFail($id);

        $orden->estado = 'Pagada';

        $orden->save();

        return redirect()->route('admins.ordenes.index')->with('success', 'La orden ah sido entregada correctamente');

    }

    
    public function Cancelada($id){
        $orden = Orden::findOrFail($id);

        $orden->estado = 'Devuelta';

        $orden->save();

        return redirect()->route('admins.ordenes.index')->with('success', 'La orden ah sido Cancelada correctamente');

    }



    public function edit($id)
    {
        $orden = Orden::findOrFail($id);
        return view('admin.ordenes.edit', compact('orden'));
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_personas_id' => 'required|integer',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'envios_domicilio' => 'required|boolean',
        ]);

        $orden = Orden::findOrFail($id);
        $orden->update($request->only(['tipo_personas_id', 'fecha', 'total', 'envios_domicilio']));

        return redirect()->route('admins.ordenes.index')->with('success', 'Orden actualizada correctamente.');
    }

    public function destroy($id)
    {
        $orden = Orden::findOrFail($id);
        $orden->delete();

        return redirect()->route('admins.ordenes.index')->with('success', 'Orden eliminada correctamente.');
    }
    
    public function listarPedidos()
    {
        $tipoPersona = auth()->user()->persona->tipoPersona()->first();

        $ordenes = Orden::where('tipo_personas_id', $tipoPersona->id)
            ->with(['detalles.edicionProducto'])
            ->orderBY('created_at', 'desc')
            ->paginate(2); 
        

        return view('cliente.pedidos', compact('ordenes'));
        
    }

  

}
