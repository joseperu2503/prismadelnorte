@extends('layouts.appProfesor')

@section('title','Home')

@section('content')
    <h1 class="titulo">
        @if (strtolower($profesor->genero) == 'masculino')
            Bienvenido
        @elseif(strtolower($profesor->genero) == 'femenino')
            Bienvenida
        @endif  
        {{ $profesor->primer_nombre}} {{ $profesor->apellido_paterno }}
    </h1>
@endsection