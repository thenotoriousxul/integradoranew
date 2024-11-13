<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edicion extends Model
{
    protected $table = 'ediciones';

    protected $fillable = [
        'nombre_eicion',
        'imagen_producto',
        'fecha_salida',
        'lote',
        'extra',
        'costo_fabricacion',
        'precio_venta',
        'tipo',
    ];

    public function productos(){
        return $this->belongsToMany(Producto::class,'ediciones_productos');
    }
}
