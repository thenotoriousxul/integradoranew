<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diseno extends Model
{
    protected $table  = 'disenos';

    protected $fillable = [
        'nombre',
        'cantidad',
        'costo',
    ];

    public function estampados()
    {
        return $this->belongsToMany(Estampado::class, 'disenos_estampados', 'diseno_id', 'estampado_id');
    }
    

}
