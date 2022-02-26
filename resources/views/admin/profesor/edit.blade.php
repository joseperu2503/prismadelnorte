@extends('layouts.appAdmin')

@section('title','Editar profesor')

@section('content')
    <h1 class="titulo">Editar profesor</h1>
    <div class="form-container">  
        <form action="/profesores/{{$profesor->id}}" method="POST">
            @csrf
            @method('PUT')
            <label class="form-label">DNI</label>
            <input id="dni" name="dni" type="number" class="input-formulario" value="{{$profesor->dni}}">
            <label class="form-label">Apellido Paterno</label>
            <input id="apellido_paterno" name="apellido_paterno" type="text" class="input-formulario" value="{{$profesor->apellido_paterno}}">
            <label class="form-label">Apellido Materno</label>
            <input id="apellido_materno" name="apellido_materno" type="text" class="input-formulario" value="{{$profesor->apellido_materno}}">
            <label class="form-label">Primer Nombre</label>
            <input id="primer_nombre" name="primer_nombre" type="text" class="input-formulario" value="{{$profesor->primer_nombre}}"> 
            <label class="form-label">Segundo Nombre</label>
            <input id="segundo_nombre" name="segundo_nombre" type="text" class="input-formulario" value="{{$profesor->segundo_nombre}}">          
            <label class="form-label">Telefono</label>
            <input id="telefono" name="telefono" type="number" class="input-formulario" value="{{$profesor->telefono}}">
            <label class="form-label">Email</label>
            <input id="email" name="email" type="text" class="input-formulario" value="{{$profesor->email}}">
            <label class="form-label">Dirección</label>
            <input id="direccion" name="direccion" type="text" class="input-formulario" value="{{$profesor->direccion}}">
            <label class="form-label">Genero</label>
            <input id="genero" name="genero" type="text" class="input-formulario" value="{{$profesor->genero}}">

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        - {{ $error }} <br />
                    @endforeach
                </div>
            @endif
            <div class="buttons-form">
                <a href="/profesores">
                    <button type="button" class="boton btn-rojo" >Cancelar</button>
                </a>
                <button type="submit" class="boton btn-verde">Actualizar</button>
            </div>          
        </form>
    </div>
@endsection