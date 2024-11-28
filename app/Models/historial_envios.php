<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historial_envios extends Model
{
    protected $table = 'historial_envios';

    protected $fillable = [
        'envios_id',
        'estado_envio',
        'fecha'];


    public function envio()
      {
    return $this->belongsTo(envios::class, 'envios_id');
      }

}
