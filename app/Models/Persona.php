<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    Use HasFactory;
    protected $table = 'personas';

    protected $fillable = [
        'users_id',
        'direcciones_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'genero',
        'numero_telefonico'
        ];

        public function user()
        {
            return $this->belongsTo(User::class, 'users_id');
        }
    
        public function direccion()
        {
            return $this->belongsTo(Direccion::class, 'direcciones_id');
        }
    
        public function tipoPersona()
        {
            return $this->hasMany(TipoPersona::class, 'personas_id');
        }
}
