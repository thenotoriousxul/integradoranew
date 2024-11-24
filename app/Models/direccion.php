<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class direccion extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
    'calle',
    'colonia',
    'numero_ext',
    'numero_int',
    'estado',
    'codigo_postal',
    'pais',
    ];

    public function envios()
    {
    return $this->hasMany(envios::class, 'direcciones_id');
    }

}
