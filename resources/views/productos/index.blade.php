@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
<h3>Listado de Productos

<a href="productos/create"><button class="btn btn-success">Nuevo</button></a>
<button type="button" id="bt_pdf" class="btn btn-info">Pdf</button>  </h3>

 

@include('productos/search')

</div>
</div>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
<table class="table table-striped table-bordered table-condensed table-hover">

    <thead>
        <th>Código</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Descripción</th>
        <th>Imagen</th>
        <th>Estado</th>
        <th>Acciones</th>
    </thead>
    @foreach($productos as $producto)
    <tr>
        <td>{{$producto->codigo}}</td>
<td>{{$producto->nombre}}</td>
<td>{{$producto->categoria}}</td>
<td>{{$producto->descripcion}}</td>
<td><img src="/storage/{{ $producto->imagen}}" class="img-fluid" width="50" height="50"></td>
<td>{{$producto->estado}}</td>
<td>

<a href="{{action('ProductoController@edit',$producto->id)}}"> <button class="btn btn-info">Editar</button></a>
   
 
    <a href="" data-target="#modal-delete-{{$producto->id}}" data-toggle="modal"> <button class="btn btn-danger">Eliminar</button></a>

</td>
    </tr>
    @include('productos.modal')
    @endforeach
</table>
    
    </div>
{{$productos->links()}}

</div>


</div>
@push('scripts')
<script>
    $(document).ready(function(){
    $('#bt_pdf').click(function(){
  
window.open('http://localhost:8000/productos/listarPdf','_blank');
//alert("Error al ingresar detalle");

    
    });
    
    });
    </script>
@endpush
@endsection