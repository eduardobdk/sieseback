<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeguimientoRegistro extends Model
{
    protected $table = 'seguimiento_registros'; //

    protected $fillable = [
        'titulo',     // <-- Asegúrate de que esta línea esté aquí
        'extension',
        'archivo',
        'link'
    ];
}
