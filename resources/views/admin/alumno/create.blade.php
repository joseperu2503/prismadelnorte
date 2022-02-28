@extends('layouts.appAdmin')

@section('title','Nuevo Alumno')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection
@section('content')
    <h1 class="titulo">Nuevo Alumno</h1>
    <div class="form-container">  
        <form action="/alumnos" method="POST">
            @csrf    
            <label class="form-label">DNI</label>
            <input id="dni" name="dni" type="number" class="form-control mb-3" value="{{old('dni')}}">
            <label class="form-label">Apellido Paterno</label>
            <input id="apellido_paterno" name="apellido_paterno" type="text" class="form-control mb-3" value="{{old('type')}}">
            <label class="form-label">Apellido Materno</label>
            <input id="apellido_materno" name="apellido_materno" type="text" class="form-control mb-3" value="{{old('apellido_materno')}}">
            <label class="form-label">Primer nombre</label>
            <input id="primer_nombre" name="primer_nombre" type="text" class="form-control mb-3" value="{{old('primer_nombre')}}">
            <label class="form-label">Segundo nombre</label>
            <input id="segundo_nombre" name="segundo_nombre" type="text" class="form-control mb-3" value="{{old('segundo_nombre')}}">
            <label class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="number" class="form-control mb-3" value="{{old('telefono')}}">
            <input type="hidden" class="form-label" name="id_aula" value="{{$aula->id}}">
            <label class="form-label">Email</label>
            <input id="email" name="email" type="text" class="form-control mb-3" value="{{old('email')}}">
            <label class="form-label">Dirección</label>
            <input id="direccion" name="direccion" type="text" class="form-control mb-3" value="{{old('direccion')}}">
            <input type="hidden" class="form-label" name="foto_perfil" value="foto por defecto">
            <label class="form-label">Género</label>
            <input id="genero" name="genero" type="text" class="form-control mb-3" value="{{old('genero')}}">   
            <label class="form-label">Contraseña</label>
            <input id="password" name="password" type="text" class="form-control mb-3" value="{{old('password')}}">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        - {{ $error }} <br />
                    @endforeach
                </div>
            @endif
            <div class="buttons-form">
                <a href="/alumnos/{{$aula->id}}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>          
        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@endsection