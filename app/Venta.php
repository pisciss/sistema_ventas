<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $fillable = ['id_cliente', 'tipo_comprobante', 'serie_comprobante', 'num_comprobante', 'fecha_hora', 'impuesto', 'total_venta', 'estado'];
}
