@extends('layouts.appAdmin')

@section('title','Nuevo Curso')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection

@section('content')
    <h1 class="titulo">Nuevo Curso</h1>
    <div class="form-container">  
        <form action="/cursos" method="POST">
            @csrf
            <label class="form-label">Código</label>
            <input id="codigo" name="codigo" type="text" class="form-control mb-3" tabindex="1" value="{{old('codigo')}}" required>
            <label class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control mb-3" tabindex="2" value="{{old('nombre')}}" required>
            <label class="form-label">Aula</label>
 
            <select id="id_aula" name="id_aula" class="form-select mb-3" required>
                <option selected disabled value="">Seleccione una opción</option>
                @foreach ($aulas as $aula)
                    <option value="{{$aula->id}}">{{$aula->grado}} de {{$aula->nivel}}</option>
                @endforeach                                     
            </select>
  
            <label class="form-label">Profesor</label>

            <select name="id_profesor" class="form-select mb-3" required>
                <option selected disabled value="">Seleccione una opción</option>
                @foreach ($profesores as $profesor)
                    <option value="{{$profesor->id}}">{{$profesor->primer_nombre}} {{$profesor->apellido_paterno}}</option>
                @endforeach                                     
            </select>
        
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        - {{ $error }} <br />
                    @endforeach
                </div>
            @endif
            <div class="buttons-form">
                <a href="/cursos" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>          
        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@endsection