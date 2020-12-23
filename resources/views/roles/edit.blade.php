@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-md-4 mx-auto">
<h3>Editar Rol</h3>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors ->all() as $error)
    
    <li>{{$error}}</li>
    @endforeach
</ul>

</div>
@endif

{!!Form::model($role,['method'=>'PATCH','route'=>['roles.update',$role->id]])!!}
{{Form::token()}}
 
          <div  class="form-group">
          <label for="name">Rol</label>
          <input type="text" class="form-control" name="name" value="{{$role->name}}"  placeholder="Nombre del Rol">
        
        </div>
        <div  class="form-group">
          <label for="slug">Descripción</label>
          <input type="text" class="form-control" name="slug"  value="{{$role->slug}}" placeholder="Role Slug">
        </div>
       
        <div  class="form-group">
          <label for="roles_permissions">Add Permisos</label>
          <input type="text" data-role="tagsinput" name="roles_permissions" class="form-control" id="roles_permissions" value="@foreach ($role->permissions as $permission)
          {{$permission->name. ","}}
      @endforeach">   
        </div>
       
   <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="reset" onclick="window.history.back();"  class="btn btn-danger">Cancelar</button>
    </div>
 {!!Form::close()!!}
  
</div>
</div>
@section('css_role_page')
<link rel="stylesheet" href="/css/bootstrap-tagsinput.css">
@endsection

@push('scripts')
<script src="/js/bootstrap-tagsinput.js"></script>
<script>
$(document).ready(function(){
$('#name').keyup(function(e){
var str = $('#name').val();
str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
$('#slug').val(str);
$('#slug').attr('placeholder',str);

});

});

</script>
@endpush

@endsection