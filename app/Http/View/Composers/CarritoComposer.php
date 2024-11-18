<?php

namespace App\Http\View\Composers;
use Illuminate\View\View;

class CarritoComposer
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

 
    public function compose(View $view)
    {
        $contenidoCarrito = collect(session()->get('carrito', []));
        $totalMonto = $contenidoCarrito->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        $view->with('contenidoCarrito', $contenidoCarrito)
             ->with('totalMonto', $totalMonto);    }

}
