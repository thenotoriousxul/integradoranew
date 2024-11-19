<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\CodeCleaner\ReturnTypePass;

class Estampado extends Model
{
    use HasFactory;

    protected $table = 'estampados'; 

    protected $fillable = [
        'nombre',
        'imagen_estampado',
        'costo',
    ];

    public function disenos()
    {
        return $this->belongsToMany(Diseno::class, 'disenos_estampados', 'estampado_id', 'diseno_id');
    }
}
