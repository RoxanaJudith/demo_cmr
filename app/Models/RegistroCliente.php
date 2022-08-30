<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroCliente extends Model
{
    use HasFactory;

    protected Cliente $cliente;
    protected Verificacion $verificacion;
    protected $paso1;
    protected $paso2;
    protected $paso3;
}
