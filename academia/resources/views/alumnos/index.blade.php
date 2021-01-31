@extends('plantillas.plantilla')
@section('titulo')
Academia
@endsection
@section('cabecera')
Gestion de Alumnos
@endsection
@section('contenido')
@if($text=Session::get('mnesaje'))
<p class="alert alert-danger my-3">{{$text}}</p>
@endif
<a href="{{route('alumnos.create')}}" class="btn btn-info mb-3"><i class="fa fa-plus"></i> Crear alumno</a>
<table class="table table-striped table-dark">
    <thead>
      <tr>
        <th scope="col">Detalles</th>
        <th scope="col" class="align-middle">Nombre</th>
        <th scope="col" class="align-middle">Apellidos</th>
        <th scope="col" class="align-middle">Email</th>
        <th scope="col" class="align-middle">Telefono</th>
        <th scope="col" class="align-middle">Imagen</th>
      </tr>
    </thead>
    <tbody>
        @foreach($alumnos as $alumno)
      <tr class="align-middle">
        <th scope="row" class="align-middle">
        <a href="{{route('alumnos.show', $alumno)}}" class="btn btn-success fa fa-address-card fa-2x">Detalles</a>
        </th>
        <td class="align-middle">{{$alumno->nombre}}</td>
      <td class="align-middle">{{$alumno->apellidos}}</td>
      <td class="align-middle">{{$alumno->email}}</td>
      <td class="align-middle">{{$alumno->telefono}}</td>
      <td class="align-middle"><img src="{{asset($alumno->foto)}}" width="95rem" height="90rem" ></td>
       <td class="align-middle" style="white-space: :nowrap">
          <form class="form-inline" name="del" action="{{route('alumnos.destroy', $alumno)}}" method='POST'>
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('¿Borrar Alumno')">
                <i class="fas fa-trash"></i> Borrar</button>
                <a href="{{route('alumnos.edit', $alumno)}}" class="btn btn-primary btn-lg"><i class="fa fa-edit"></i> Editar</a>
          </form>
      </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{$alumnos->links()}}

@endsection
