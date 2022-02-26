@extends('layouts.appAdmin')

@section('title','Asistencia')

@section('content')
<h1 class = "titulo">Asistencia</h1>		
<h2 class="fecha">{{$fecha}}</h2>
<button id="btn-abrir-popup-nuevo" class="boton btn-verde">Cambiar de camara</button>
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

<div class="camara-grid">
    <video id="preview" width="100%" class="video"></video>
    <form action="/agregando_asistencia" method="POST" class="form">
        @csrf
        @method('PUT')
        <label>ID del alumno</label>
        <input type="text" name="text" id="text" readonny="" placeholder="Código escaneado" class="input-formulario">
    </form>               
</div>
<h2 class = "titulo-2">Asistencias recien registradas </h2>
<div class="tabla-grid tabla-4">
    @foreach ($asistencias as $asistencia)
        <div class = "table-body">{{$asistencia->apellido_paterno}} {{$asistencia->apellido_materno}} {{$asistencia->primer_nombre}} {{$asistencia->segundo_nombre}}</div>
        <div class = "table-body">{{$asistencia->created_at->format('d/m/Y')}}</div>
        <div class = "table-body">{{$asistencia->created_at->format('H:i:s')}}</div>
        <div class = "table-body">{{$asistencia->estado}}</div>
    @endforeach
</div>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="{{asset('js/asistencia.js')}}"></script>
@endsection