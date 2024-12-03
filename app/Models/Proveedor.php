<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
    'nombre',
    'numero_telefonico',
    'direcciones_id',
    'tipo',
    ];

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direcciones_id');
    }

    public function disenos()
{
    return $this->hasMany(Diseno::class, 'proveedores_id');
}

public function productos()
{
    return $this->hasMany(Producto::class, 'proveedores_id');
}




}
