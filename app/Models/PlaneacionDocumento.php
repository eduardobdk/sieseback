<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaneacionDocumento extends Model {
    use HasFactory;
    protected $fillable = ['titulo', 'portada', 'archivo'];
}
