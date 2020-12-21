{!! Form::open(array('url' => 'roles','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

<div class="from-group">

    <div class="input-group">
        <input type="text" class="form-control" name="busca" placeholder="Buscar..." value="{{$busca}}">
        <span class="input-group-btn">
<button type="submit" class="btn btn-primary"> Buscar</button>

        </span>
    </div>

</div>


{{
Form::close()

}}