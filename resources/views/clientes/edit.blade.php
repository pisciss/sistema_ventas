@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-md-4 mx-auto">
<h3>Editar clientes</h3>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors ->all() as $error)
    
    <li>{{$error}}</li>
    @endforeach
</ul>

</div>
@endif

<form action="{{ route('clientes.update',$cliente->id)}}"  method="post">
  @method('PATCH')
  @csrf
  <div class="form-group row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="codigo">Nombre</label>
        <input type="text" value="{{$cliente->nombre}}"  class="form-control" name="nombre" >
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <label for="codigo">Dirección</label>
      <input type="text"  value="{{$cliente->direccion}}" class="form-control" name="direccion">
  </div>
   
</div>
<div class="form-group row">
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
      <label for="tipo_documento" class="col-4 col-form-label">Tipo Documento</label> 
<div >
<select id="tipo_documento" name="tipo_documento" class="form-control">

<option value="CUIT" {{ $cliente->tipo_documento == 'CUIT' ? 'selected' : '' }} >CUIT</option>
<option value="CUIL" {{ $cliente->tipo_documento == 'CUIL' ? 'selected' : '' }}>CUIL</option>
<option value="CDI" {{ $cliente->tipo_documento == 'CDI' ? 'selected' : '' }}>CDI</option>
<option value="LE" {{ $cliente->tipo_documento == 'LE' ? 'selected' : '' }}>LE</option>
<option value="LC" {{ $cliente->tipo_documento == 'LC' ? 'selected' : '' }}>LC</option>
<option value="DNI" {{ $cliente->tipo_documento == 'DNI' ? 'selected' : '' }}>DNI</option>
<option value="PASAPORTE" {{ $cliente->tipo_documento == 'PASAPORTE' ? 'selected' : '' }}>PASAPORTE</option>

</select>
</div>
  </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="num_documento">N° Documento</label>
        <input type="text" class="form-control"  value="{{$cliente->num_documento}}"  name="num_documento" placeholder="Número de Documento">
    </div>
</div>
<div class="form-group row">
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <label for="telefono">Teléfono</label>
      <input type="number"  value="{{$cliente->telefono}}" class="form-control" name="telefono" placeholder="Teléfono">
  </div>
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <label for="email">Email</label>
      <input type="email" class="form-control"  value="{{$cliente->email}}"  name="email" >
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