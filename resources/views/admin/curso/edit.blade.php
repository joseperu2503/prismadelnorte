@extends('layouts.appAdmin')

@section('title','Editar Curso')

@section('content')
    <h1 class="titulo">Editar Curso</h1>
    <div class="form-container">  
        <form action="/cursos/{{$curso->id}}" method="POST">
            @csrf
            @method('PUT')
            <label class="form-label">Código</label>
            <input id="codigo" name="codigo" type="text" class="input-formulario" value="{{$curso->codigo}}">
            <label class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="input-formulario" value="{{$curso->nombre}}">
            <label class="form-label">Aula</label>
            <div class="select-container">
                <select name="id_aula" class="input-formulario select-form" required>
                    <option selected disabled value="">Seleccione una opción</option>
                    @foreach ($aulas as $aula)                       
                        @if ($curso->id_aula == $aula->id)
                            <option selected value="{{$aula->id}}">{{$aula->grado}} de {{$aula->nivel}}</option>
                        @else
                            <option value="{{$aula->id}}">{{$aula->grado}} de {{$aula->nivel}}</option>
                        @endif                      
                    @endforeach                                     
                </select>
                <i class="fas fa-angle-down"></i>
            </div>
            <label class="form-label">Profesor</label>
            <div class="select-container">
                <select name="id_profesor" class="input-formulario select-form" required>
                    <option selected disabled value="">Seleccione una opción</option>
                    @foreach ($profesores as $profesor)                       
                        @if ($curso->id_profesor == $profesor->id)
                            <option selected value="{{$profesor->id}}">{{$profesor->primer_nombre}} {{$profesor->apellido_paterno}}</option>
                        @else
                            <option value="{{$profesor->id}}">{{$profesor->primer_nombre}} {{$profesor->apellido_paterno}}</option>
                        @endif                      
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
                <a href="/cursos">
                    <button type="button" class="boton btn-rojo">Cancelar</button>
                </a>
                <button type="submit" class="boton btn-verde">Actualizar</button>
            </div>          
        </form>
    </div>
@endsection