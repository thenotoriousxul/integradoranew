<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class proveedor extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
    'nombre',
    'numero_telefonico',
    'tipo',
    ];
}
