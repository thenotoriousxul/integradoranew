<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pago extends Model
{
    Use HasFactory;
    protected $table = 'pago';

    protected $fillable = [
        'ordenes_id',
        'descuento',
        'pago_total',
        'metodo_pago',
        'fecha_pago',
        'estado',
        'num_referencia'];

        public function orden()
        {
            return $this->belongsTo(Orden::class, 'ordenes_id');
        }


}
