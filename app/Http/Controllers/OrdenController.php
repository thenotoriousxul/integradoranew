<?php
namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\DetalleOrden;
use App\Models\Edicion;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::all();
        return view('admin.ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        return view('admin.ordenes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_personas_id' => 'required|integer',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'envios_domicilio' => 'required|boolean',
        ]);

        $fecha_orden = $request->get('fecha');

        $orden = Orden::create([
            'tipo_personas_id' => $request->tipo_personas_id,
            'fecha_orden' => $fecha_orden,
            'total' => $request->total,
            'envios_domicilio' => $request->envios_domicilio,
            'estado' => 'Pendiente',
        ]);


        return redirect()->route('admins.ordenes.index')->with('success', 'Orden registrada correctamente.');
    }

    public function show($id)
    {
        $orden = Orden::with('detalles.edicion')->findOrFail($id);
        return view('admin.ordenes.show', compact('orden'));
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
            ->paginate(10); // Muestra 10 registros por página
        
        return view('cliente.pedidos', compact('ordenes'));
        
    }

  

}
