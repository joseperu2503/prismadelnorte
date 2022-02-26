@extends('layouts.appProfesor')

@section('title','Home')

@section('content')
    <h1 class="titulo">Bienvenido {{ $profesor->primer_nombre}} {{ $profesor->apellido_paterno }}</h1>
@endsection