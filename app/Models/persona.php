<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona extends Model
{
    Use HasFactory;
    protected $table = 'personas';

    protected $fillable = [
        'direccion_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'genero',
        ];

        public function user()
        {
            return $this->belongsTo(User::class, 'users_id');
        }
    
        // Relación 1 a 1 con el modelo Direccion
        public function direccion()
        {
            return $this->belongsTo(direccion::class, 'direcciones_id');
        }
    
        // Relación 1 a muchos con el modelo TipoPersona
        public function tiposPersonas()
        {
            return $this->hasMany(tipoPersona::class, 'personas_id');
        }
}
