@extends('layouts.app')

@section('botones')

<a href="{{ route('pacientes.create')}}" class="btn btn-primary mr-2">Nuevo Paciente</a>
@endsection

@section('content')




    <h2 class="text-center mb-4">Pacientes</h2>

<div  class="col-md-10 mx-auto p-3"></div>
    <table class="table table-sm" id="pac-table">
        <thead>
        <tr>
          <th scope="col">id</th>
            <th scope="col">Apellido</th>
            <th scope="col">Nombre</th>
            <th scope="col">Documento</th>
            <th scope="col">Fecha Nacimiento</th>
            <th scope="col">Sexo</th>
            <th scope="col">&nbsp;</th>
         
         </tr>
          
        </thead>
       
      </table>
      <div class="col-12 mt-4 justify-content-center d-flex"> 
   
      
      </div>
     

@endsection

@section('scripts') 
<script>
$(document).ready( function () {
    $('#pac-table').DataTable({
processing:true,
serverSider:true,
ajax: '{!! route('dataTablePaciente') !!}',
columns:[
  {data: 'id', name:'id'},
  {data: 'apellido', name:'apellido'},
  {data: 'nombre', name:'nombre'},
  {data: 'documento', name:'documento'},
  {data: 'fecha_nacimiento', name:'fecha_nacimiento'},
  {data: 'sexo', name:'sexo'},
  {data: 'btn'},
]
    });
} );

</script>
@endsection