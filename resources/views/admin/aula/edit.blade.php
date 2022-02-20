@extends('layouts.appAdmin')

@section('title','Editar aula')

@section('content')
    <h2>Editar Aula</h2>
    <form action="/aulas/{{$aula->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Código</label>
            <input id="codigo" name="codigo" type="text" class="form-control" value="{{$aula->codigo}}" >
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Grado</label>
            <input id="grado" name="grado" type="text" class="form-control" value="{{$aula->grado}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nivel</label>
            <input id="nivel" name="nivel" type="text" class="form-control" value="{{$aula->nivel}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Abreviatura</label>
            <input id="abreviatura" name="abreviatura" type="text" class="form-control"value="{{$aula->abreviatura}}">
        </div>
        <a href="/aulas" class="btn btn-warning" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-success" tabindex="4">Actualizar</button>

    </form>
@endsection