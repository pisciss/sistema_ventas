@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
<h3>Nuevo Ingreso</h3>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors ->all() as $error)
    
    <li>{{$error}}</li>
    @endforeach
</ul>

</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
      {{ session('error') }}
</div>
@endif

<form action="{{ route('ingresos.store')}}"  method="post">
    {!! csrf_field()  !!}
 
    <div class="form-group row">
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
          <label for="proveedor">Proveedor</label>
        <select name="id_proveedor" id="id_proveedor" class="form-control">
        @foreach($proveedores as $proveedor)
        <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
@endforeach
        </select>
      </div>
      
     
  </div>
  <div class="form-group row">
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12" >
        <label for="tipo_comprobante" >Tipo Comprobante</label> 
<div>
<select id="tipo_comprobante" name="tipo_comprobante" class="form-control">

<option value="Boleta">Boleta</option>
<option value="Factura">Factura</option>
<option value="Ticket">TIcket</option>


</select>
</div>
    </div>
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
      <div class="form_group">
          <label for="serie_comprobante">Serie Comprobante</label>
          <input type="text" class="form-control" value="{{old('serie_comprobante')}}"  name="serie_comprobante" placeholder="Serie de comprobante">
      </div>
  </div>
  <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
      <div class="form_group">
          <label for="num_comprobante">Nro Comprobante</label>
          <input type="text" class="form-control" required value="{{old('num_comprobante')}}"  name="num_comprobante" placeholder="Número de comprobante">
      </div>
  </div>
  </DIV>
<div class="row">
<div class="panel panel-primary">
<div class="panel-body">
<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
<div class="form-group">
<label for="producto">Producto</label>
<select name="pidproducto" class="form-group selectpicker" id="pidproducto" data-live-search="true">
@foreach($productos as $producto)
<option value="{{$producto->id}}">{{$producto->producto}}</option>
@endforeach
</select>
</div>
</div>
<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
<div class="form-group">
<label for="cantidad">Cantidad</label>
<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="cantidad">
</div>
</div>
<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
<div class="form-group">
<label for="precio_compra">Precio Compra</label>
<input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="precio compra">
</div>
</div>
<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
<div class="form-group">
<label for="precio_venta">Precio Venta</label>
<input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="precio venta">
</div>
</div>
<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
<div class="form-group">
<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
</div>
</div>

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
<tABLE id="detalles" class="table table-striped table-bordered table-condensed table-hover">
<thead style="background-color:#A9D0F5">
<th>Opciones</th>
<th>Producto</th>
<th>Cantidad</th>
<th>Precio Compra</th>
<th>Precio Venta</th>
<th>Subtotal</th>
</thead>

<tfoot>
<th>Total</th>
<th></th>
<th></th>
<th></th>
<th></th>
<th><h4 id="total"></h4></th>
</tfoot>
<tbody></tbody>
</tABLE>
</div>

</div>

</div>


</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
  <div class="form-group">
  <input type="hidden" name="_token" value="{{csrf_token()}}"> 
    <button type="submit" class="btn btn-primary">Guardar</button>
    <button type="reset" onclick="window.history.back();"  class="btn btn-danger">Cancelar</button>
</div>
</div>
</div>
  </form>
  
</div>
</div>
@push('scripts')
<script>
$(document).ready(function(){
$('#bt_add').click(function(){
agregar();

});

});
var cont=0;
subtotal=[];
total=0;
function limpiar(){
$("#pcantidad").val("");
$("#pprecio_compra").val("");
$("#pprecio_venta").val("");
}
function evaluar()
{
if(total>0){
$("#guardar").show();

}
else{
  $("#guardar").hide();

}

}
function eliminar(index){
total=total-subtotal[index];
$("#total").html("S/."+ total);
$("#fila" + index).remove();
evaluar();

}
function agregar(){
id_producto=$("#pidproducto").val();
producto=$("#pidproducto option:selected").text();
cantidad=$("#pcantidad").val();
precio_compra=$("#pprecio_compra").val();
precio_venta=$("#pprecio_venta").val();

if(id_producto !="" && cantidad !="" && cantidad>0 && precio_compra!="" && precio_venta!="")
{
subtotal[cont]=(cantidad*precio_compra);
total=total+subtotal[cont];

var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X </button></td><td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';

cont++;
limpiar();
$("#total").html("S/." + total);
evaluar();
//append agrega contenido al final del elemento seleccionado
$('#detalles').append(fila);
}
else{

  alert("Error al ingresar detalle");
}

}

</script>
@endpush
@endsection