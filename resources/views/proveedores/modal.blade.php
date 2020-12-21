
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-delete-{{$proveedor->id}}">
<form action="{{route('proveedores.destroy',$proveedor->id)}}" method="POST">

    @csrf
    @method('DELETE')
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
<h4 class="modal-title">Eliminar Proveedor</h4>

            </div>
            <div class="modal-body">
<p>Confirme si desea eliminar el proveedor</p>
            </div>
            <div class="modal-footer">
<button type="button" class="btn btn-dfault" data-dismiss="modal">Cerrar</button>
<button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>

   
    
    </form>
    </div>