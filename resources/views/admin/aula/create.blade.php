@extends('layouts.appAdmin')

@section('title','Aulas')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection
@section('content')
    <h1 class="titulo">Nueva Aula</h1>
    <div class="form-container">  
        <form action="/aulas" method="POST">
            @csrf
            <label class="form-label">Código</label>
            <input id="codigo" name="codigo" type="text" class="form-control mb-3" tabindex="1" value="{{old('codigo')}}">
            <label class="form-label">Grado</label>
            <input id="grado" name="grado" type="text" class="form-control mb-3" tabindex="2" value="{{old('grado')}}">
            <label class="form-label">Nivel</label>
            <input id="nivel" name="nivel" type="text" class="form-control mb-3" tabindex="3" value="{{old('nivel')}}">
            <label class="form-label">Abreviatura</label>
            <input id="abreviatura" name="abreviatura" type="text" class="form-control mb-3" tabindex="4" value="{{old('abreviatura')}}">           
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        - {{ $error }} <br />
                    @endforeach
                </div>
            @endif
            <div class="buttons-form">
                <a href="/aulas" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>          
        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@endsection