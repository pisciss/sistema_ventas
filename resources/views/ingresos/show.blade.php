@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
<h3>Ver Ingreso</h3>

 
    <div class="form-group row">
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
          <label for="proveedor">Proveedor</label>
        <p>{{$ingreso->nombre}}</p>
      </div>
      
     
  </div>
  <div class="form-group row">
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12" >
        <label for="tipo_comprobante" >Tipo Comprobante</label> 
        <p>{{$ingreso->tipo_comprobante}}</p>
    </div>
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
      <div class="form_group">
          <label for="serie_comprobante">Comprobante</label>
          <p>{{$ingreso->serie_comprobante}} - {{$ingreso->num_comprobante}}</p>
      </div>
  </div>
 
  </DIV>
<div class="row">
<div class="panel panel-primary">
<div class="panel-body">

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
<tABLE id="detalles" class="table table-striped table-bordered table-condensed table-hover">
<thead style="background-color:#A9D0F5">

<th>Producto</th>
<th>Cantidad</th>
<th>Precio Compra</th>
<th>Precio Venta</th>
<th>Subtotal</th>
</thead>

<tfoot>

<th></th>
<th></th>
<th></th>
<th></th>
<th><h4 id="total">{{$ingreso->total}}</h4></th>
</tfoot>
<tbody>
@foreach($detalles as $det)
  <tr>
<td>{{$det->producto}}</td>
<td>{{$det->cantidad}}</td>
<td>{{$det->precio_compra}}</td>
<td>{{$det->precio_venta}}</td>
<td>{{$det->cantidad*$det->precio_compra}}</td>
  </tr>
@endforeach

</tbody>
</tABLE>
</div>

</div>

</div>


</div>

</div>
  
  
</div>
</div>

@endsection