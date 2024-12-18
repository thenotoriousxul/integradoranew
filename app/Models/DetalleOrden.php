<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    use HasFactory;

    protected $table = 'detalle_ordenes';

    protected $fillable = [
        'ediciones_productos_id',
        'ordenes_id',
        'cantidad',
        'total',
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'ordenes_id');
    }

    public function EdicionProducto()
    {
        return $this->belongsTo(EdicionesProductos::class, 'ediciones_productos_id');
    }

    public function edicion()
    {
        return $this->edicionProducto->belongsTo(Edicion::class, 'edicion_id');
    }
}
