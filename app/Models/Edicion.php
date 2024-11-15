<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edicion extends Model
{
    protected $table = 'edicion';

    protected $fillable = [
        'nombre_edicion',
        'fecha_de_salida',
        'lote',
        'existencias',
        'extra',
        'costo_fabricacion',
        'precio_de_venta',
        'tipo',
        'imagen_producto',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'ediciones_productos', 'edicion_id', 'productos_id')
                    ->withPivot('lote', 'existencias');
    }
}
