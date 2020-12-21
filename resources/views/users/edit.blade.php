@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-md-4 mx-auto">
<h3>Editar Usuario</h3>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors ->all() as $error)
    
    <li>{{$error}}</li>
    @endforeach
</ul>

</div>
@endif

<form action="{{ route('users.update',$user->id)}}"  method="post">
  @method('PATCH')
  @csrf
  <div class="form-group row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="name">Usuario</label>
        <input type="text" value="{{$user->name}}"  class="form-control" name="name" >
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <label for="email">Email</label>
      <input type="email"  value="{{$user->email}}" class="form-control" name="email">
  </div>
   
</div>

<div class="form-group row">
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <label for="password">Contraseña</label>
      <input type="password" placeholder="contraseña"  class="form-control" name="password" >
  </div>
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <label for="password_confirm">Repetir contraseña</label>
    <input type="password" placeholder="contraseña" class="form-control" name="password_confirm">
</div>
 
</div>    



<div class="form-group">
  <button type="submit" class="btn btn-primary">Guardar</button>
  <button type="reset" onclick="window.history.back();"  class="btn btn-danger">Cancelar</button>
</div>
</form>
  
</div>
</div>


@endsection