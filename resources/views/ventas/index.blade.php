@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
<h3>Listado de Ventas <a href="ventas/create"><button class="btn btn-success">Nuevo</button></a> </h3>

@include('ventas/search')

</div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
<table class="table table-striped table-bordered table-condensed table-hover">

    <thead>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Tipo Comprobante</th>
        <th>Serie Comprobante</th>
        <th>Número Comprobante</th>
        <th>Impuesto</th>
        <th>Total</th>
        <th>Estado</th>
        <th>Opciones</th>
    </thead>
    @foreach($ventas as $ven)
    <tr>
<td>{{$ven->fecha_hora}}</td>
<td>{{$ven->nombre}}</td>
<td>{{$ven->tipo_comprobante}}</td>
<td>{{$ven->serie_comprobante}}</td>
<td>{{$ven->num_comprobante}}</td>
<td>{{$ven->impuesto}}</td>
<td>{{$ven->total_venta}}</td>
<td>{{$ven->estado}}</td>
<td>
    <a href="{{action('VentaController@show',$ven->id)}}"> <button class="btn btn-primary">Detalles</button></a>
    <a href="" data-target="#modal-delete-{{$ven->id}}" data-toggle="modal"> <button class="btn btn-danger">Anular</button></a>
</td>
    </tr>
    @include('ventas.modal')
    @endforeach
</table>
    
    </div>
{{$ventas->links()}}

</div>


</div>

@endsection