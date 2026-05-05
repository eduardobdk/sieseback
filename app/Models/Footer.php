<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'contacto_1', 'contacto_2', 'direccion', 
        'copyright', 'url_facebook', 'url_twitter', 'url_web'
    ];
}