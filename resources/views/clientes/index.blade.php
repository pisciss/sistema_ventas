@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
<h3>Listado de clientes <a href="clientes/create"><button class="btn btn-success">Nuevo</button></a> </h3>

@include('clientes/search')

</div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
<table class="table table-striped table-bordered table-condensed table-hover">

    <thead>
        <th>Nombre</th>
        <th>Tipo Documento</th>
        <th>N° Documento</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Email</th>
    </thead>
    @foreach($clientes as $cliente)
    <tr>
<td>{{$cliente->nombre}}</td>
<td>{{$cliente->tipo_documento}}</td>
<td>{{$cliente->num_documento}}</td>
<td>{{$cliente->direccion}}</td>
<td>{{$cliente->telefono}}</td>
<td>{{$cliente->email}}</td>
<td>
    <a href="{{action('ClienteController@edit',$cliente->id)}}"> <button class="btn btn-info">Editar</button></a>
    <a href="" data-target="#modal-delete-{{$cliente->id}}" data-toggle="modal"> <button class="btn btn-danger">Eliminar</button></a>
</td>
    </tr>
    @include('clientes.modal')
    @endforeach
</table>
    
    </div>
{{$clientes->links()}}

</div>


</div>

@endsection