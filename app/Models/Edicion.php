<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edicion extends Model
{
    protected $table = 'edicion';

    protected $fillable = [
        'nombre_edicion',
        'descripcion',
        'fecha_de_salida',
        'lote',
        'existencias',
        'extra',
        'tipo',
    ];

    public function productos(){
        return $this->hasMany(Producto::class, 'ediciones_poductos');
      }

    
      public function estampados()
      {
          return $this->belongsToMany(
              Estampado::class,          
              'ediciones_estampados',    
              'edicion_id',              
              'estampado_id'             
          );
      }
}
