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
        $ordenes = Orden::all(); // Obtén todas las órdenes
        return view('admin.ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        return view('admin.ordenes.create'); // Vista del formulario de creación
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_personas_id' => 'required|integer',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'envios_domicilio' => 'required|boolean',
        ]);

        $orden = Orden::create($request->only(['tipo_personas_id', 'fecha', 'total', 'envios_domicilio']));

        return redirect()->route('admins.ordenes.index')->with('success', 'Orden registrada correctamente.');
    }

    public function show($id)
    {
        $orden = Orden::with('detalles.edicion')->findOrFail($id); // Incluye detalles y ediciones
        return view('admin.ordenes.show', compact('orden'));
    }

    public function edit($id)
    {
        $orden = Orden::findOrFail($id); // Encuentra la orden
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
    // Obtener el usuario autenticado
    $usuario = auth()->user();

    // Filtrar las órdenes por el ID del cliente autenticado
    $ordenes = Orden::where('tipo_personas_id', $usuario->id)
        ->with('detalles.edicion') // Incluir detalles y ediciones relacionadas
        ->get();

    return view('cliente.pedidos', compact('ordenes'));
}

}
