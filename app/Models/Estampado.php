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
        'imagen_estampado',
        'costo',
    ];

    /**
     * Relación muchos a muchos con el modelo Diseno.
     */
    public function disenos()
    {
        return $this->belongsToMany(
            Diseno::class,            
            'disenos_estampados',    
            'estampado_id',           
            'diseno_id'              
        );
    }
}
