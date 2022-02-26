@extends('layouts.appAdmin')

@section('title','Nuevo Curso')

@section('content')
    <h1 class="titulo">Nuevo Curso</h1>
    <div class="form-container">  
        <form action="/cursos" method="POST">
            @csrf
            <label class="form-label">Código</label>
            <input id="codigo" name="codigo" type="text" class="input-formulario" tabindex="1" value="{{old('codigo')}}" required>
            <label class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="input-formulario" tabindex="2" value="{{old('nombre')}}" required>
            <label class="form-label">Aula</label>
            <div class="select-container">
                <select name="id_aula" class="input-formulario select-form" required>
                    <option selected disabled value="">Seleccione una opción</option>
                    @foreach ($aulas as $aula)
                        <option value="{{$aula->id}}">{{$aula->grado}} de {{$aula->nivel}}</option>
                    @endforeach                                     
                </select>
                <i class="fas fa-angle-down"></i>
            </div>
            <label class="form-label">Profesor</label>
            <div class="select-container">
                <select name="id_profesor" class="input-formulario select-form" required>
                    <option selected disabled value="">Seleccione una opción</option>
                    @foreach ($profesores as $profesor)
                        <option value="{{$profesor->id}}">{{$profesor->primer_nombre}} {{$profesor->apellido_paterno}}</option>
                    @endforeach                                     
                </select>
                <i class="fas fa-angle-down"></i>
            </div>           
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        - {{ $error }} <br />
                    @endforeach
                </div>
            @endif
            <div class="buttons-form">
                <a href="/cursos" tabindex="5">
                    <button type="button" class="boton btn-rojo" >Cancelar</button>
                </a>
                <button type="submit" class="boton btn-verde" tabindex="6">Guardar</button>
            </div>          
        </form>
    </div>
@endsection