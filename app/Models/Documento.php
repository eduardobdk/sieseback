<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    // Esta línea es la que falta y corrige el error de tu captura
    protected $fillable = [
        'titulo',
        'archivo',
        'extension',
        'seccion',
        'anio',
        'categoria'
    ];
}