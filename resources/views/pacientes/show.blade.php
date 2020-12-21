@extends('layouts.app')

@section('content')

<h1>Paciente</h1>
<article>
<h2 class="text-center mb-4">{{$paciente->apellido }}, {{$paciente->nombre }}</h1>

<div class="imagen-paciente">
<img src="/storage/{{ $paciente->imagen}}" class="w-50">

</div>

<div class="paciente-meta">
<p>
<span class="font-weght-bold text-primary"> Documento:</span>
{{$paciente->documento}}
</p>
<p>
    <span class="font-weght-bold text-primary"> Fecha de Nacimiento:</span>
@php
    $fecha = $paciente->fecha_nacimiento
@endphp
    <fecha-paciente fecha="{{$fecha}}"></fecha-paciente>
    </p>
</div>

</article>

@endsection