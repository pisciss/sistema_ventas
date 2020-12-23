@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
<h3>Listado de Usuarios <a href="users/create"><button class="btn btn-success">Nuevo</button></a> </h3>

@include('users/search')

</div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
<table class="table table-striped table-bordered table-condensed table-hover">

    <thead>
        <th>Nombre</th>
             <th>Email</th>
             <th>Roles</th>
             <th>Permisos</th>
    </thead>
    @foreach($users as $user)
    <tr>
<td>{{$user->name}}</td>
<td>{{$user->email}}</td>
<td>
    @if($user->roles->isNotEmpty())
@foreach($user->roles as $role)
    <span class="badge badge-secondary">
{{$role->name}}

    </span>
@endforeach
@endif
</td>
<td>  @if($user->permissions->isNotEmpty())
    @foreach($user->permissions as $permission)
        <span class="badge badge-secondary">
    {{$permission->name}}
    
        </span>
    @endforeach
    @endif</td>
<td>
    <a href="{{action('UserController@edit',$user->id)}}"> <button class="btn btn-info">Editar</button></a>
    <a href="" data-target="#modal-delete-{{$user->id}}" data-toggle="modal"> <button class="btn btn-danger">Eliminar</button></a>
</td>
    </tr>
    @include('users.modal')
    @endforeach
</table>
    
    </div>
{{$users->links()}}

</div>


</div>

@endsection