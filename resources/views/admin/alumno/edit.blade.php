@extends('layouts.appAdmin')

@section('title','Editar Alumno')

@section('content')
<h1 class="titulo">Editar Alumno</h1>
<div class="form-container">  
    <form action="/alumnos/{{$alumno->id}}" method="POST">
        @csrf
        @method('PUT')
        <label class="form-label">DNI</label>
        <input id="dni" name="dni" type="number" class="input-formulario" value="{{$alumno->dni}}">
        <label class="form-label">Primer nombre</label>
        <input id="primer_nombre" name="primer_nombre" type="text" class="input-formulario" value="{{$alumno->primer_nombre}}">
        <label class="form-label">Segundo nombre</label>
        <input id="segundo_nombre" name="segundo_nombre" type="text" class="input-formulario" value="{{$alumno->segundo_nombre}}">
        <label class="form-label">Apellido Paterno</label>
        <input id="apellido_paterno" name="apellido_paterno" type="text" class="input-formulario" value="{{$alumno->apellido_paterno}}">
        <label class="form-label">Apellido Materno</label>
        <input id="apellido_materno" name="apellido_materno" type="text" class="input-formulario" value="{{$alumno->apellido_materno}}">
        <label class="form-label">Telefono</label>
        <input id="telefono" name="telefono" type="number" class="input-formulario" value="{{$alumno->telefono}}">
        <label class="form-label">Aula</label>
        <input id="id_aula" name="id_aula" type="text" class="input-formulario" value="{{$alumno->id_aula}}">
        <label class="form-label">Email</label>
        <input id="email" name="email" type="text" class="input-formulario" value="{{$alumno->email}}">
        <label class="form-label">Dirección</label>
        <input id="direccion" name="direccion" type="text" class="input-formulario" value="{{$alumno->direccion}}">
        <input type="hidden" class="form-label" name="foto_perfil" value="foto por defecto">
        <label class="form-label">Genero</label>
        <input id="genero" name="genero" type="text" class="input-formulario" value="{{$alumno->genero}}"> 
        <label class="form-label">Contraseña</label>
        <input id="password" name="password" type="text" class="input-formulario">  
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    - {{ $error }} <br />
                @endforeach
            </div>
        @endif
        <div class="buttons-form">
            <a href="/alumnos">
                <button type="button" class="boton btn-rojo" >Cancelar</button>
            </a>
            <button type="submit" class="boton btn-verde" tabindex="1">Actualizar</button>
        </div>          
    </form>
</div>

@endsection