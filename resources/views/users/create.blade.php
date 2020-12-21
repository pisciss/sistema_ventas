@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-md-4 mx-auto">
<h3>Nuevo Usuario</h3>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors ->all() as $error)
    
    <li>{{$error}}</li>
    @endforeach
</ul>

</div>
@endif
<form action="{{ route('users.store')}}"  method="post">
    {!! csrf_field()  !!}
 
    <div class="form-group row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
          <label for="name">Usuario</label>
          <input type="text" value="{{old('name')}}" placeholder="Usuario"  class="form-control" name="name" >
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="email">Email</label>
        <input type="email"  value="{{old('email')}}" placeholder="Email" class="form-control" name="email">
    </div>
     
  </div>
  
  <div class="form-group row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="password">Contraseña</label>
        <input type="password" placeholder="contraseña"  class="form-control" name="password" >
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <label for="password_confirmation">Repetir contraseña</label>
      <input type="password" placeholder="contraseña" class="form-control" name="password_confirmation">
  </div>
   
  </div>    
  <div class="form-group row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="role">Rol</label>
       >
    </div>
    <div id="permissions_box"></div>
   
</div>
  
  
  <div class="form-group">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <button type="reset" onclick="window.history.back();"  class="btn btn-danger">Cancelar</button>
  </div>
  </form>
  
</div>
</div>


@endsection