@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-md-4 mx-auto">
<h3>Nuevo Cliente</h3>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors ->all() as $error)
    
    <li>{{$error}}</li>
    @endforeach
</ul>

</div>
@endif
<form action="{{ route('clientes.store')}}"  method="post">
    {!! csrf_field()  !!}
 
    <div class="form-group row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
          <label for="codigo">Nombre</label>
          <input type="text" value="{{old('nombre')}}"  class="form-control" name="nombre" placeholder="Nombre">
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="codigo">Dirección</label>
        <input type="text" value="{{old('direccion')}}"  class="form-control" name="direccion" placeholder="Dirección">
    </div>
     
  </div>
  <div class="form-group row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
        <label for="tipo_documento" class="col-4 col-form-label">Tipo Documento</label> 
<div >
<select id="tipo_documento" name="tipo_documento" class="form-control">

<option value="CUIT.">CUIT.</option>
<option value="CUIL">CUIL</option>
<option value="CDI">CDI</option>
<option value="LE">LE</option>
<option value="LC">LC</option>
<option value="DNI">DNI</option>
<option value="PASAPORTE">PASAPORTE</option>

</select>
</div>
    </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
          <label for="num_documento">N° Documento</label>
          <input type="text" class="form-control" value="{{old('num_documento')}}"  name="num_documento" placeholder="Número de Documento">
      </div>
  </div>
  <div class="form-group row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="telefono">Teléfono</label>
        <input type="number" value="{{old('telefono')}}" class="form-control" name="telefono" placeholder="Teléfono">
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="email">Email</label>
        <input type="email" class="form-control" value="{{old('email')}}"  name="email" placeholder="Email">
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