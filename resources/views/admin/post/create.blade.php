@extends('layouts.appAdmin')

@section('title','Nueva Publicación')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection
@section('content')
    <h1 class="titulo">Nueva Publicación</h1>
    <div class="form-container">  
        <form action="/publicaciones" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="form-label">Título</label>
            <input id="titulo" name="titulo" type="text" class="form-control mb-3" value="{{old('titulo')}}">           
            
            <label class="form-label">Imagen</label>
            <label class="btn btn-outline-primary w-100 mb-3">
                <i class="fas fa-image"></i>
                <p class="m-0">Seleccione la imagen</p>
                <input id="imagen" type="file" name="imagen" class="hidden" >
            </label>
            <div class="d-flex justify-content-center my-3">
                <img class="col-12 col-sm-8 col-md-6"  id="imagenSeleccionada">
            </div>  
    
            <label class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" type="text" class="form-control mb-3" rows="5" >{{old('descripcion')}}</textarea>
            <label class="form-label">Contenido embebido</label>
            <input id="iframe" name="iframe" type="text" class="form-control mb-3" value="{{old('iframe')}}">           
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        - {{ $error }} <br />
                    @endforeach
                </div>
            @endif
            <div class="buttons-form">
                <a href="/publicaciones" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>          
        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    {{-- Scripts para mostrar la imagen cuando se seleccione --}}
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