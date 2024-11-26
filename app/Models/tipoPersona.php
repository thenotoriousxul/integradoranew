<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoPersona extends Model
{
    Use HasFactory;

    protected $table = 'tipo_personas';

    protected $fillable = [
        'personas_id',
        'tipo_persona',
        'curp',
        'rfc',
        'numero_ss'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'personas_id');
    }
    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'tipo_personas_id');
    }
}
