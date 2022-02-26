@extends('layouts.appAdmin')

@section('title','Nuevo Alumno')

@section('content')
    <h1 class="titulo">Nuevo Alumno</h1>
    <div class="form-container">  
        <form action="/alumnos" method="POST">
            @csrf
            <label class="form-label">DNI</label>
            <input id="dni" name="dni" type="number" class="input-formulario" tabindex="1" value="{{old('dni')}}">
            <label class="form-label">Primer nombre</label>
            <input id="primer_nombre" name="primer_nombre" type="text" class="input-formulario" tabindex="2" value="{{old('primer_nombre')}}">
            <label class="form-label">Segundo nombre</label>
            <input id="segundo_nombre" name="segundo_nombre" type="text" class="input-formulario" tabindex="3" value="{{old('segundo_nombre')}}">
            <label class="form-label">Apellido Paterno</label>
            <input id="apellido_paterno" name="apellido_paterno" type="text" class="input-formulario" tabindex="4" value="{{old('type')}}">
            <label class="form-label">Apellido Materno</label>
            <input id="apellido_materno" name="apellido_materno" type="text" class="input-formulario" tabindex="5" value="{{old('apellido_materno')}}">
            <label class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="number" class="input-formulario" tabindex="6" value="{{old('telefono')}}">
            <input type="hidden" class="form-label" name="id_aula" value="{{$aula->id}}">
            <label class="form-label">Email</label>
            <input id="email" name="email" type="text" class="input-formulario" tabindex="7" value="{{old('email')}}">
            <label class="form-label">Dirección</label>
            <input id="direccion" name="direccion" type="text" class="input-formulario" tabindex="8" value="{{old('direccion')}}">
            <input type="hidden" class="form-label" name="foto_perfil" value="foto por defecto">
            <label class="form-label">Genero</label>
            <input id="genero" name="genero" type="text" class="input-formulario" tabindex="9" value="{{old('genero')}}">   
            <label class="form-label">Contraseña</label>
            <input id="password" name="password" type="text" class="input-formulario" tabindex="10" value="{{old('password')}}">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        - {{ $error }} <br />
                    @endforeach
                </div>
            @endif
            <div class="buttons-form">
                <a href="/alumnos/{{$aula->id}}" tabindex="11">
                    <button type="button" class="boton btn-rojo" >Cancelar</button>
                </a>
                <button type="submit" class="boton btn-verde" tabindex="12">Guardar</button>
            </div>          
        </form>
    </div>
@endsection