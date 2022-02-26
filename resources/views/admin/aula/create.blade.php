@extends('layouts.appAdmin')

@section('title','Aulas')

@section('content')
    <h1 class="titulo">Nueva Aula</h1>
    <div class="form-container">  
        <form action="/aulas" method="POST">
            @csrf
            <label class="form-label">Código</label>
            <input id="codigo" name="codigo" type="text" class="input-formulario" tabindex="1" value="{{old('codigo')}}">
            <label class="form-label">Grado</label>
            <input id="grado" name="grado" type="text" class="input-formulario" tabindex="2" value="{{old('grado')}}">
            <label class="form-label">Nivel</label>
            <input id="nivel" name="nivel" type="text" class="input-formulario" tabindex="3" value="{{old('nivel')}}">
            <label class="form-label">Abreviatura</label>
            <input id="abreviatura" name="abreviatura" type="text" class="input-formulario" tabindex="4" value="{{old('abreviatura')}}">           
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
                <button type="submit" class="boton btn-verde" tabindex="6">Guardar</button>
            </div>          
        </form>
    </div>
@endsection