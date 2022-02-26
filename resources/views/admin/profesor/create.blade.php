@extends('layouts.appAdmin')

@section('title','Nuevo Profesor')

@section('content')
    <h1 class="titulo">Nuevo Profesor</h1>
    <div class="form-container">  
        <form action="/profesores" method="POST">
            @csrf
            <label class="form-label">DNI</label>
            <input id="dni" name="dni" type="number" class="input-formulario" tabindex="1" value="{{old('dni')}}">
            <label class="form-label">Apellido Paterno</label>
            <input id="apellido_paterno" name="apellido_paterno" type="text" class="input-formulario" tabindex="2" value="{{old('apellido_paterno')}}">
            <label class="form-label">Apellido Materno</label>
            <input id="apellido_materno" name="apellido_materno" type="text" class="input-formulario" tabindex="3" value="{{old('apellido_materno')}}">
            <label class="form-label">Primer Nombre</label>
            <input id="primer_nombre" name="primer_nombre" type="text" class="input-formulario" tabindex="4" value="{{old('primer_nombre')}}"> 
            <label class="form-label">Segundo Nombre</label>
            <input id="segundo_nombre" name="segundo_nombre" type="text" class="input-formulario" tabindex="5" value="{{old('segundo_nombre')}}">          
            <label class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="number" class="input-formulario" tabindex="7" value="{{old('telefono')}}">
            <label class="form-label">Email</label>
            <input id="email" name="email" type="text" class="input-formulario" tabindex="8" value="{{old('email')}}">
            <label class="form-label">Dirección</label>
            <input id="direccion" name="direccion" type="text" class="input-formulario" tabindex="9" value="{{old('direccion')}}">
            <label class="form-label">Genero</label>
            <input id="genero" name="genero" type="text" class="input-formulario" tabindex="10" value="{{old('genero')}}">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        - {{ $error }} <br />
                    @endforeach
                </div>
            @endif
            <div class="buttons-form">
                <a href="/profesores" tabindex="11">
                    <button type="button" class="boton btn-rojo" >Cancelar</button>
                </a>
                <button type="submit" class="boton btn-verde" tabindex="12">Guardar</button>
            </div>          
        </form>
    </div>
@endsection