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
        return $this->hasMany(Edicion::class, 'ediciones_poductos');
      }

    
      public function estampados()
      {
          return $this->belongsToMany(
              Estampado::class,          // Modelo relacionado
              'ediciones_estampados',    // Nombre de la tabla pivote
              'edicion_id',              // Clave foránea en la tabla pivote para "Edicion"
              'estampado_id'             // Clave foránea en la tabla pivote para "Estampado"
          );
      }
}
