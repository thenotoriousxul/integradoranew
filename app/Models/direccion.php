<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class direccion extends Model
{
    protected $table = 'direcciones';

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
    public function persona()
    {
        return $this->hasOne(Persona::class, 'direcciones_id');
    }

}
