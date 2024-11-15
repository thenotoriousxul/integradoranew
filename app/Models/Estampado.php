<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estampado extends Model
{
    use HasFactory;

    protected $table = 'estampados'; 

    protected $fillable = [
        'nombre',
        'imagen_diseño',

    ];
}
