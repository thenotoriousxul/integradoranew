<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ediciones_productos extends Model
{
    Use HasFactory;
    protected $table = 'ediciones_productos';
    protected $primaryKey ='id';
    protected $fillable = [
        'nombre',
        'talla',
        'costo_fabrica',
        'costo_precio_venta',
        'cantidad',
        'rebaja',
        'porcentaje_rebaja',
        'precio_rebajado',
        'productos_id',
        'edicion_id',
    ];
}
