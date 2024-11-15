<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    
      protected $table = 'productos';

     
      protected $fillable = [
          'tipo',
          'tamaño',
          'color',
          'lote',
          'costo',
          'imagen_producto',
          'estado',
      ];

      public function ediciones(){
        return $this->belongsToMany(Edicion::class, 'ediciones_poducto');
      }
}
