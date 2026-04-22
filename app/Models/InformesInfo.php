<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformesInfo extends Model
{
    // Esto le dice a Laravel que use la tabla que acabas de crear
    protected $table = 'informes_info'; 
    protected $fillable = ['descripcion'];
}