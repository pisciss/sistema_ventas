<form action="{{route('pacientes.destroy',$id)}}" method="POST">
@csrf
@method('DELETE')
<a href="{{route('pacientes.edit',$id)}}" class="btn btn-success btn-sm">Editar</a>
<a href="{{route('pacientes.show',$id)}}" class="btn btn-warning btn-sm">Mostrar</a>
<input type="submit" name="submit" value="Delete" class="btn btn-sm btn-danger"
onclick="return confirm('Are you sure?')">

</form>