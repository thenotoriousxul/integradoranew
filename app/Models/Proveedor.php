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

public function productoProveedores()
{
    return $this->hasMany(Productos_Proveedores::class, 'proveedores_id');
}





}
