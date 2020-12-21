@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
<h3>Listado de Proveedores <a href="proveedores/create"><button class="btn btn-success">Nuevo</button></a> </h3>

@include('proveedores/search')

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
    @foreach($proveedores as $proveedor)
    <tr>
<td>{{$proveedor->nombre}}</td>
<td>{{$proveedor->tipo_documento}}</td>
<td>{{$proveedor->num_documento}}</td>
<td>{{$proveedor->direccion}}</td>
<td>{{$proveedor->telefono}}</td>
<td>{{$proveedor->email}}</td>
<td>
    <a href="{{action('ProveedorController@edit',$proveedor->id)}}"> <button class="btn btn-info">Editar</button></a>
    <a href="" data-target="#modal-delete-{{$proveedor->id}}" data-toggle="modal"> <button class="btn btn-danger">Eliminar</button></a>
</td>
    </tr>
    @include('proveedores.modal')
    @endforeach
</table>
    
    </div>
{{$proveedores->links()}}

</div>


</div>

@endsection