@extends('plantillas.plantilla')
@section('titulo')
Academia
@endsection
@section('cabecera')
Detalle de Alumnos
@endsection
@section('contenido')
@if($text=Session::get('mensaje'))
<p class="alert alert-info my-3">{{$text}}</p>
@endif
<div class="card text-white bg-secondary mt-5 mx-auto text-center">
    <div class="card-body">
        <h5 class="card-title text-center">Codigo: {{($alumno->id)}}</h5>
        <div class="text-center"><img src="{{asset($alumno->foto)}}" width="140px" heght="140px" class="rounded-circle"></div>
        <p class="card-text"><b>Nombre:</b> {{$alumno->nombre}}</p>
        <p class="card-text"><b>Apellidos:</b> {{$alumno->apellidos}}</p>
        <p class="card-text"><b>Email:</b> {{$alumno->email}}</p>
        <p class="card-text"><b>Telefono:</b> {{$alumno->telefono}}</p>

    <a href="{{route('alumnos.index')}}" class="mt-3 float-right btn btn-success">Volver</a>
    </div>
</div>
@endsection
