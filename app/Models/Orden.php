<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'ordenes';

    protected $fillable = [
        'tipo_personas_id',
        'fecha_orden',
        'direcciones_id', 
        'total',
        'envios_domicilio',
        'estado'
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleOrden::class, 'ordenes_id');
    }


   public function tipoPersona()
   {
       return $this->belongsTo(TipoPersona::class, 'tipo_personas_id');
   }

   public function pagos()
   {
       return $this->hasMany(Pago::class, 'ordenes_id');
   }

}
 