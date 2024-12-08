<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'vista_auditoria_general';
    protected $primaryKey = 'auditoria_id';
    public $timestamps = false;  // No hay columnas created_at ni updated_at

    protected $fillable = [
        'tipo_auditoria', 'entidad_nombre', 'modificador', 'accion', 'estado_anterior', 'estado_actual', 'fecha'
    ];

}
