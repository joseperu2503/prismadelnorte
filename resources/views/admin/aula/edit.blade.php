@extends('layouts.appAdmin')

@section('title','Editar aula')

@section('content')
    <h1 class="titulo">Editar Aula</h1>
    <div class="form-container">  
        <form action="/aulas/{{$aula->id}}" method="POST">
            @csrf
            @method('PUT')
            <label class="form-label">Código</label>
            <input id="codigo" name="codigo" type="text" class="input-formulario" value="{{$aula->codigo}}">
            <label class="form-label">Grado</label>
            <input id="grado" name="grado" type="text" class="input-formulario" value="{{$aula->grado}}">
            <label class="form-label">Nivel</label>
            <input id="nivel" name="nivel" type="text" class="input-formulario" value="{{$aula->nivel}}">
            <label class="form-label">Abreviatura</label>
            <input id="abreviatura" name="abreviatura" type="text" class="input-formulario" value="{{$aula->abreviatura}}">           
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        - {{ $error }} <br />
                    @endforeach
                </div>
            @endif
            <div class="buttons-form">
                <a href="/aulas" tabindex="5">
                    <button type="button" class="boton btn-rojo" >Cancelar</button>
                </a>
                <button type="submit" class="boton btn-verde" tabindex="1">Actualizar</button>
            </div>          
        </form>
    </div>
@endsection