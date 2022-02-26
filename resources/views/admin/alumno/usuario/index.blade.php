@extends('layouts.appAlumno')

@section('title','Home')

@section('content')
    <h1 class="titulo">Bienvenido {{ $alumno->primer_nombre }} {{ $alumno->apellido_paterno }}</h1>
@endsection