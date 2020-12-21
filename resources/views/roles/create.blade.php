@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-md-4 mx-auto">
<h3>Nuevo Rol</h3>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors ->all() as $error)
    
    <li>{{$error}}</li>
    @endforeach
</ul>

</div>
@endif
<form action="{{ route('roles.store')}}"  method="post">
    {!! csrf_field()  !!}
 
          <div  class="form-group">
          <label for="name">Rol</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}"  placeholder="Nombre del rol" required>
        
        </div>
        <div  class="form-group">
          <label for="slug">Slug</label>
          <input type="text" class="form-control" id="slug" name="slug"  value="{{ old('slug')}}" placeholder="Slug" required>
        </div>
        <div  class="form-group">
          <label for="roles_permissions">Add Permisos</label>
          <input type="text" class="form-control" name="roles_permissions"  value="{{ old('roles_permissions')}}" data-role="tagsinput" id="roles_permissions" required>
        </div>
   
   <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="reset" onclick="window.history.back();"  class="btn btn-danger">Cancelar</button>
    </div>
  </form>
  
</div>
</div>


@endsection