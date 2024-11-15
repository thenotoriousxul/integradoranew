<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidosController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::where('user_id', auth()->id())->get();
        return view('pedidos', compact('pedidos'));
    }

    public function detalle($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('detalle-pedido', compact('pedido'));
    }
}
