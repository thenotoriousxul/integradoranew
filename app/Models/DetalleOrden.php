<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    use HasFactory;

    protected $table = 'detalle_ordenes';

    protected $fillable = [
        'edicion_id',
        'ordenes_id',
        'cantidad',
        'precio',
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'ordenes_id');
    }

    public function edicion()
    {
        return $this->belongsTo(Edicion::class, 'edicion_id');
    }
}
