@extends('plantillas.plantilla')
@section('titulo')
Academia
@endsection
@section('cabecera')
Gestion de Alumnos
@endsection
@section('contenido')
<div class="container mt-3">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="text-center"><img src="{{asset($alumno->foto)}}" width="140px" heght="140px" class=" rounded-circle" ></div>
<form name="editar" action="{{route('alumnos.update', $alumno)}}" method="POST">
    @csrf
    @method('PUT')
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" value="{{$alumno->nombre}}" placeholder="nombre" name="nombre" required>
          </div>
          <div class="col">
            <input type="text" class="form-control" value="{{$alumno->apellidos}}" placeholder="apellido" name="apellidos" required>
          </div>

        </div>
        <div class="row mt-3">
                <div class="col">
                  <input type="email" class="form-control" value="{{$alumno->email}}"  name="email" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" value="{{$alumno->telefono}}"  placeholder="telefono" name="telefono">
                  </div>
              </div>
              <div class="row mt-4">
                  <!-- NO FUNCIONA EL UPDATE DE LA FOTO -->
                <!--<div class="col">
                    <input type="file" name="foto" class="form-control-file" accept="image/*">
                </div>-->
                <div class="col">
                    <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i>Modificar</button>
                    <a href="{{route('alumnos.index')}}"class="btn btn-primary"><i class="fa fa-house-user">Inicio</i></a>
                </div>
            </div>
      </form>
@endsection
