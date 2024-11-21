<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    
      protected $table = 'productos';

     
      protected $fillable = [
          'tipo',
          'talla',
          'color',
          'lote',
          'costo',
          'imagen_producto',
          'estado',
          'producto_personalizar'
      ];

      public function ediciones(){
        return $this->hasMany(Edicion::class, 'ediciones_poductos');
      }
}
