@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-md-4 mx-auto">
<h3>Nuevo Producto</h3>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors ->all() as $error)
    
    <li>{{$error}}</li>
    @endforeach
</ul>

</div>
@endif
<form action="{{ route('productos.store')}}"  enctype="multipart/form-data" method="post">
    {!! csrf_field()  !!}
 
    <div class="form-group row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
          <label for="codigo">Código</label>
          <input type="text" value="{{old('codigo')}}"  class="form-control" name="codigo" placeholder="Código">
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
          <label for="id_categoria" class="col-4 col-form-label">Categoría</label> 
<div >
<select id="id_categoria" name="id_categoria" class="form-control">
  @foreach($categorias as $cat)
<option value="{{$cat->id}}">{{$cat->nombre}}</option>
@endforeach
</select>
</div>
      </div>
  </div>
  <div class="form-group row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
          <label for="nombre">Nombre</label>
          <input type="text" required value="{{old('nombre')}}" class="form-control" name="nombre" placeholder="Street Address">
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
          <label for="descripcion">Descripción</label>
          <input type="text" class="form-control" value="{{old('descripcion')}}"  name="descripcion" placeholder="Line 2">
      </div>
  </div>
  <div class="form-group row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="precio_compra">Precio de compra</label>
        <input type="number" step="0.01" min="0" max="9999999" value="{{old('precio_compra')}}" class="form-control" name="precio_compra" placeholder="Precio de compra">
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="precio_venta">Precio de venta</label>
        <input type="number"  step="0.01" min="0" max="9999999" class="form-control" value="{{old('precio_venta')}}"  name="precio_venta" placeholder="Precio de venta">
    </div>
</div>
     <div class="form-group row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" value="{{old('stock')}}"  name="stock" >
        </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
          <label for="imagen">Imagen</label>
          <input type="file" class="form-control" id="imagen" name="imagen" >
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