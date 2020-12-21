<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_venta';
    protected $fillable = ['id_venta', 'id_producto', 'cantidad', 'precio_venta', 'descuento'];
}
