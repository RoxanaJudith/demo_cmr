<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'cedula_identidad', 'complemento', 'expedido', 'nombre', 'apellido_paterno', 'apellido_materno', 'correo_electronico', 'fecha_nacimiento', 'estado_civil', 'direccion', 'nacionalidad', 'celular', 'genero', 'direccion', 'foto_selfie', 'foto_ci_anverso', 'foto_ci_reverso'
    ];

    public function cuentas()
    {
        return $this->hasMany(Cuenta::class);
    }
}
