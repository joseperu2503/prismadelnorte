@extends('layouts.appAlumno')

@section('title','Cursos')

@section('content')

<h1 class = "titulo">Perfil</h1>
<div class = "perfil-fondo">
    <div class = "perfil-container">
        <div class = "perfil-encabezado">
            <img class = "perfil-imagen" src="{{$alumno->foto_perfil}}" alt="foto de perfil">
            <button title="Cambiar foto" class = "camera" id="btn-abrir-popup-nuevo">
                <i class="fas fa-camera "></i>
            </button>
            <div class = "perfil-encabezado-nombre">
                <h2>{{$alumno->primer_nombre}} {{$alumno->apellido_paterno}}</h2>
                <p>{{$aula->grado}} de {{$aula->nivel}}</p>
            </div>
        </div>

        <div class = "perfil-grid-encabezado">Datos del estudiante</div>

        <div class = "perfil-grid">
            <div class ="perfil-grid-left">DNI</div>
            <div class ="perfil-grid-right">{{$alumno->dni}}</div>
            <div class ="perfil-grid-left">Telefono</div>
            <div class ="perfil-grid-right">{{$alumno->telefono}}</div>
            <div class ="perfil-grid-left">Correo electronico</div>
            <div class ="perfil-grid-right">{{$alumno->email}}</div>           
            <div class ="perfil-grid-left">Direccion</div>
            <div class ="perfil-grid-right">{{$alumno->direccion}}</div>
        </div>					
    </div>	
</div>

<div class="overlay-nuevo" id="overlay-nuevo">
    <div class="popup-nuevo" id="popup-nuevo">
        <div class = "popup-header-nuevo">                  
            <h3 class = "popup-titulo-nuevo">Actualizar foto de perfil</h3>
            <a href="#" id="btn-cerrar-popup-nuevo" class="btn-cerrar-popup-nuevo"><i class="fas fa-times"></i></a>
        </div>

        <div class="imagen">
            <img src="{{$alumno->foto_perfil}}" width="200px" id="imagenSeleccionada">
        </div>  
        <form  id="upload_image" action="/alumno/{{$alumno->id}}/actualizar_foto" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label class="seleccione_imagen">
                <i class="fas fa-image"></i>
                <p>Seleccione la imagen</p>
                <input id="imagen" type="file" name="foto_perfil" class="hidden" >
            </label>

            <button type="submit" name="submit" class="hecho">Hecho</button>
            </div>
        </form>				
    </div>
</div>

<script>
    var btnAbrirPopup_nuevo = document.getElementById('btn-abrir-popup-nuevo'),
	overlay_nuevo = document.getElementById('overlay-nuevo'),
	popup_nuevo = document.getElementById('popup-nuevo'),
	btnCerrarPopup_nuevo = document.getElementById('btn-cerrar-popup-nuevo');


    btnAbrirPopup_nuevo.addEventListener('click', function(){
        overlay_nuevo.classList.add('active');
        popup_nuevo.classList.add('active');
    });

    btnCerrarPopup_nuevo.addEventListener('click', function(e){
        e.preventDefault();
        overlay_nuevo.classList.remove('active');
        popup_nuevo.classList.remove('active');
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script>   
    $(document).ready(function (e) {   
        $('#imagen').change(function(){            
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#imagenSeleccionada').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });
</script>

@endsection