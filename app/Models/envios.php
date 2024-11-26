<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class envios extends Model
{
    Use HasFactory;

    protected $table = 'envios';
    

    protected $fillable = [
        'ordenes_id',
        'direccion_id',
        'costo_envio',
        'estado_envio',
        'fecha_envio',
        'fecha_entregado',
    ];

    public function orden()
    {
        return $this->hasone(Orden::class, 'ordenes_id');
    }
    public function direccion()
    {
        return $this->belongsTo(direccion::class, 'direccion_id');
    }
    public function historial()
    {
    return $this->hasMany(historial_envios::class, 'envios_id');
    }

}
