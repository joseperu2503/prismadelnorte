@extends('layouts.appAdmin')

@section('title','Aulas')

@section('content')
    <h2>Nueva Aula</h2>
    <form action="/aulas" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Código</label>
            <input id="codigo" name="codigo" type="text" class="form-control" tabindex="1">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Grado</label>
            <input id="grado" name="grado" type="text" class="form-control" tabindex="2">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nivel</label>
            <input id="nivel" name="nivel" type="text" class="form-control" tabindex="2">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Abreviatura</label>
            <input id="abreviatura" name="abreviatura" type="text" class="form-control" tabindex="2">
        </div>
        <a href="/aulas" class="btn btn-warning" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-success" tabindex="4">Guardar</button>

    </form>
@endsection