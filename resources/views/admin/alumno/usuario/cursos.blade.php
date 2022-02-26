@extends('layouts.appAlumno')

@section('title','Cursos')

@section('content')

    <h1 class="titulo">Cursos del estudiante</h1>

    <div class = "cursos-grid">
        @foreach ($cursos as $curso)      
            <a href="/alumno/cursos/{{$curso->codigo}}">
                <article class = "curso">
                    <h2>{{$curso->nombre}}</h2>
                </article>
            </a>				
        @endforeach
    </div>
@endsection