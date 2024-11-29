<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ediciones_productos extends Model
{
    Use HasFactory;
    protected $table = 'ediciones_productos';
    protected $primaryKey ='id';
    protected $fillable = [
        'nombre',
        'cantidad',
        'rebaja',
        'porcentaje_rebaja',
        'precio_rebajado',
        'productos_id',
        'edicion_id',
        'imagen_producto_final',
        'imagen_producto_trasera',
    ];

    public function edicion(){
        return $this->belongsTo(Edicion::class);
    }
    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
