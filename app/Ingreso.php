<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    protected $fillable = ['id_proveedor', 'tipo_comprobante', 'serie_comprobante', 'num_comprobante', 'fecha_hora', 'impuesto', 'estado'];
}
