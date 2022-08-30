<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'correo_electronico', 'codigo_verificacion','fecha_expiracion'
    ];
}
