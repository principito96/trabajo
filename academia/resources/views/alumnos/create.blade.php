@extends('plantillas.plantilla')
@section('titulo')
Academia
@endsection
@section('cabecera')
Crear alumno
@endsection
@section('contenido')
@if ($errors->any())
    <div class="alert alert-danger my-3 p-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form name="c" action="{{route('alumnos.store')}}" method='POST' enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="col">
            <label for="nom" class="col-form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="nom" required>
        </div>
        <div class="col">
            <label for="ape" class="col-form-label">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" id="ape" required>
        </div>

        <div class="col">
            <label for="tel" class="col-form-label">Telefono</label>
            <input type="tel" name="telefono" class="form-control" placeholder="Telefono" maxlength="9">
        </div>

        <div class="col">
            <label for="email" class="col-form-label">E-Mail</label>
            <input type="mail" name="email" class="form-control" placeholder="e-mail" id="email" required>
        </div>

        <div class="col">
            <label for="foto" class="col-form-label">Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <div class="col">
            <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i>Crear</button>
            <button class="btn btn-warning" type="reset"><i class="fa fa-brush"></i>Borrar</button>
            <a href="{{route('alumnos.index')}}"class="btn btn-primary"><i class="fa fa-house-user">Inicio</i></a>
        </div>
    </div>
</form>
@endsection
