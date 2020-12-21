@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
<h3>Listado de Roles <a href="roles/create"><button class="btn btn-success">Nuevo</button></a> </h3>

@include('roles/search')

</div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
<table class="table table-striped table-bordered table-condensed table-hover">

    <thead>
        <th>Id</th>
        <th>Role</th>
        <th>Slug</th>
        <th>Permisos</th>
        <th>Acciones</th>
    </thead>
    @foreach($roles as $role)
    <tr>
<td>{{$role->id}}</td>
<td>{{$role->name}}</td>
<td>{{$role->slug}}</td>
<td></td>
<td>
    <a href="{{action('RoleController@edit',$role->id)}}"> <button class="btn btn-info">Editar</button></a>
    <a href="" data-target="#modal-delete-{{$role->id}}" data-toggle="modal"> <button class="btn btn-danger">Eliminar</button></a>
</td>
    </tr>
    @include('roles.modal')
    @endforeach
</table>
    
    </div>
{{$roles->links()}}

</div>


</div>

@endsection