
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-delete-{{$ing->id}}">
<form action="{{route('ingresos.destroy',$ing->id)}}" method="POST">

    @csrf
    @method('DELETE')
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
<h4 class="modal-title">Cancelar Ingreso</h4>

            </div>
            <div class="modal-body">
<p>Confirme si desea cancelar el ingreso</p>
            </div>
            <div class="modal-footer">
<button type="button" class="btn btn-dfault" data-dismiss="modal">Cerrar</button>
<button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>

   
    
    </form>
    </div>