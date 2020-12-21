<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    protected $fillable = ['apellido', 'nombre', 'documento', 'fecha_nacimiento', 'sexo', 'estado_civil', 'domicilio', 'telefono', 'celular', 'email', 'imagen', 'user_id'];
}
