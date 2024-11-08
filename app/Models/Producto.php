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
      ];
}
