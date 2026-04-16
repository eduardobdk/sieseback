<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model {
    use HasFactory;
    protected $fillable = ['titulo', 'portada', 'pdf_contexto', 'pdf_anexo1', 'pdf_anexo2'];
}
