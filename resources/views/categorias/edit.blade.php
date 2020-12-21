@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-md-4 mx-auto">
<h3>Editar Categoría</h3>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors ->all() as $error)
    
    <li>{{$error}}</li>
    @endforeach
</ul>

</div>
@endif

{!!Form::model($categoria,['method'=>'PATCH','route'=>['categorias.update',$categoria->id]])!!}
{{Form::token()}}
 
          <div  class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" name="nombre" value="{{$categoria->nombre}}"  placeholder="Nombre de la Categoría">
        
        </div>
        <div  class="form-group">
          <label for="apellido">Descripción</label>
          <input type="text" class="form-control" name="descripcion"  value="{{$categoria->descripcion}}" placeholder="Descripción">
        </div>
       
   
   <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="reset" onclick="window.history.back();"  class="btn btn-danger">Cancelar</button>
    </div>
 {!!Form::close()!!}
  
</div>
</div>


@endsection