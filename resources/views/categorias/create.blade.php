@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-md-4 mx-auto">
<h3>Nueva Categoría</h3>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors ->all() as $error)
    
    <li>{{$error}}</li>
    @endforeach
</ul>

</div>
@endif
<form action="{{ route('categorias.store')}}"  method="post">
    {!! csrf_field()  !!}
 
          <div  class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" name="nombre" value="{{ old('nombre')}}"  placeholder="Nombre de la Categoría">
        
        </div>
        <div  class="form-group">
          <label for="apellido">Descripción</label>
          <input type="text" class="form-control" name="descripcion"  value="{{ old('descripcion')}}" placeholder="Descripción">
        </div>
       
   
   <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="reset" onclick="window.history.back();"  class="btn btn-danger">Cancelar</button>
    </div>
  </form>
  
</div>
</div>


@endsection