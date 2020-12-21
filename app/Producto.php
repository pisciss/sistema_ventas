<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = ['codigo', 'nombre', 'descripcion', 'id_categoria', 'imagen', 'estado', 'precio_compra', 'precio_venta', 'stock'];
}
