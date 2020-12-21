@extends('layouts.app')

@section('botones')

<a href="{{ route('pacientes.index')}}" class="btn btn-primary mr-2">Volver</a>
@endsection

@section('content')

<h2 class="text-center mb-3"> Editar Paciente</h2>

<div class="row justify-content-center mt-3"></div>
<div class="col-md-8 mx-auto">

<form action="{{ route('pacientes.update',['paciente'=>$paciente->id])}}" enctype="multipart/form-data" method="post">
 @csrf

 @method('PUT')

    <div class="form-group row">
        <div  class="col-sm-6">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" name="nombre" value="{{ $paciente->nombre}}"  placeholder="Nombre del paciente">
      
      </div>
      <div  class="col-sm-6">
        <label for="apellido">Apellido</label>
        <input type="text" class="form-control" name="apellido"  value="{{ $paciente->apellido}}" placeholder="Apellido del paciente">
      </div>
      </div>
      <div class="form-group row">
      <div class="col-sm-6">
        <label for="documento">Documento</label>
        <input type="text" class="form-control" name="documento"  value="{{ $paciente->documento }}" placeholder="DNI del paciente">
      </div>
      <div class="col-sm-6">
        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        <input type="date" class="form-control" name="fecha_nacimiento" value="{{ $paciente->fecha_nacimiento}}" placeholder="Nacimiento del paciente">
      </div>
      <div class="col-sm-3">
        <label for="sexo">Sexo</label>
        <select class="form-control" name="sexo" id="sexo" value="{{$paciente->sexo}}">
          <option value="Femenino">Femenino</option>
          <option value="Masculino">Masculino</option>
          <option value="Indefinido">Indefinido</option>
          
        </select>
      </div>
    
      <div class="col-sm-3">
        <label for="estado_civil">Estado Civil</label>
        <select class="form-control" name="estado_civil" id="estado_civil" value="{{ $paciente->estado_civil }}">
          <option>Soltero</option>
          <option>Casado</option>
          <option>Viudo</option>
          <option>Divorciado</option>
          
        </select>
      </div>
      <div class="col-sm-6">
        <label for="domicilio">Domicilio</label>
        <input type="text" class="form-control" name="domicilio" id="domicilio" value="{{ $paciente->domicilio}}"  placeholder="Domicilio del paciente">
      </div>
    </div>
  
    <div class="form-group row">
   
      <div class="col-sm-6">
        <label for="telefono">Teléfono</label>
        <input type="text" class="form-control" name="telefono" id="telefono"  value="{{ $paciente->telefono}}" placeholder="Teléfono del paciente">
      </div>
      <div class="col-sm-6">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email"  value="{{ $paciente->email }}" placeholder="Email del paciente">
      </div>
    </div>

    <div class="form-group row">
      <div  class="float-sm-right"> 
           <label for="imagen">Foto</label>
     
 <input 
 id="imagen"
 type="file"
 class="form-control"
 name="imagen" 

    />  
<div class="mt-4">
<p>Imagen Actual:</p>

<img src="/storage/{{$paciente->imagen}}" style="width: 300px">

</div>

</div>
  </div>
      <button type="submit" class="btn btn-primary">Guardar</button>
      
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>


@endsection