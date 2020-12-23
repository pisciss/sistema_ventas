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


<div class="form-group row">
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <label for="role">Rol</label>
    <select class="role form-control" name="role" id="role">
<option value="">Seleccionar</option>
@foreach($roles as $role)
<option data-role-id="{{ $role->id }}" data-role-slug="{{ $role->slug }}" value="{{ $role->id }}" {{ $user->roles->isEmpty() || $role->name != $userRole->name ? "" : "selected"}}>{{ $role->name }}</option>
@endforeach

    </select>
  </div>
   
</div>
  <div id="permissions_box">
    <label for="rol">Select permissions</label>
  <div id="permissions_checkbox_list">

  </div>
  </div>
  @if($user->permissions->isNotEmpty())
  @if($rolePermissions != null)
      <div id="user_permissions_box" >
          <label for="roles">User Permissions</label>
          <div id="user_permissions_ckeckbox_list">                    
              @foreach ($rolePermissions as $permission)
              <div class="custom-control custom-checkbox">                         
                  <input class="custom-control-input" type="checkbox" name="permissions[]" id="{{$permission->slug}}" value="{{$permission->id}}" {{ in_array($permission->id, $userPermissions->pluck('id')->toArray() ) ? 'checked="checked"' : '' }}>
                  <label class="custom-control-label" for="{{$permission->slug}}">{{$permission->name}}</label>
              </div>
              @endforeach
          </div>
      </div>
  @endif
@endif
<div class="form-group">
  <button type="submit" class="btn btn-primary">Guardar</button>
  <button type="reset" onclick="window.history.back();"  class="btn btn-danger">Cancelar</button>
</div>
</form>
  
</div>
</div>


@push('scripts')

<script>
$(document).ready(function(){
var permissions_box=$('#permissions_box');
var permissions_checkbox_list=$('#permissions_checkbox_list');
var user_permissions_box=$('#user_permissions_box');
var user_permissions_ckeckbox_list=$('#user_permissions_ckeckbox_list');
permissions_box.hide();
$('#role').on('change', function()
{
var role = $(this).find(':selected');
var role_id=role.data('role-id');
var role_slug = role.data('role-slug');


permissions_checkbox_list.empty();
user_permissions_box.empty();
                $.ajax({
                    url: "/users/create",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                        role_slug: role_slug,
                    }
                }).done(function(data) {
                    
                    console.log(data);
                    
                    permissions_box.show();                        
                    // permissions_ckeckbox_list.empty();
                    $.each(data, function(index, element){
                        $(permissions_checkbox_list).append(       
                            '<div class="custom-control custom-checkbox">'+                         
                                '<input class="custom-control-input" type="checkbox" name="permissions[]" id="'+ element.slug +'" value="'+ element.id +'">' +
                                '<label class="custom-control-label" for="'+ element.slug +'">'+ element.name +'</label>'+
                            '</div>'
                        );
                    });
                });
            });
        });

</script>
@endpush
@endsection