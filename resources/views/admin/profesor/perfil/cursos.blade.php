@extends('layouts.appProfesor')

@section('title','Cursos')

@section('content')

    <h1 class="titulo">Cursos</h1>
    <div class = "tabla-grid tabla-6">
        <div class = "table-header-left">ID</div>
        <div class = "table-header-center">Código</div>
        <div class = "table-header-center">Nombre</div>
        <div class = "table-header-center">Profesor</div>		
        <div class = "table-header-center">Aula</div>				
        <div class = "table-header-right">Acciones</div>
        
        @foreach ($cursos as $curso)
            <div class = "table-body">{{$curso->id}}</div>
            <div class = "table-body">{{$curso->codigo}}</div>
            <div class = "table-body">{{$curso->nombre}}</div>	
            <div class = "table-body">{{$curso->primer_nombre}} {{$curso->apellido_paterno}}</div>	
            <div class = "table-body">{{$curso->grado}} de {{$curso->nivel}}</div>								
            <div class = "acciones-3">
                <a href="/curso/{{$curso->id}}">
                    <button class="boton btn-verde">Entrar</button>
                </a>             
                </form>
            </div>	      
        @endforeach        
    </div>    
@endsection