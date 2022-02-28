@extends('layouts.appAdmin')

@section('title','Publicaciones')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection
@section('content')

    <h1 class="titulo">Publicaciones</h1>
    <a href="publicaciones/create" class="btn btn-success mb-4">Nuevo</a>
    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
                <div class="card col-12 offset-0 mb-4 col-md-8 offset-md-2 mb-4 shadow">   
                    <div class="dropdown mt-2">
                        <button class="dropdown-toggle puntos" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="/publicaciones/{{$post->id}}/edit">Editar</a></li>
                            <li>
                                <form action="{{route('publicaciones.destroy',$post->id)}}" method="POST" class="dropdown-item formEliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border: none; background:transparent">Eliminar</button>
                                </form>
                            </li>
                        </ul>
                    </div> 
                    @if (isset($post->imagen))
                        <div class="d-flex justify-content-center mt-3">
                            <img src="{{$post->imagen}}" style="width: 100%;max-height: 600px;object-fit: contain">
                        </div>
                    @endif     
                    @if (isset($post->iframe))
                        <div class="ratio ratio-16x9 mt-3" >
                            {!! $post->iframe !!}
                        </div>
                    @endif         
                    
                    <div class="card-body">
                        <h3 class="card-title mb-3">{{$post->titulo}}</h3>
                        <p class="card-text">{{$post->descripcion}}</p>
                        <div class="d-flex justify-item-center gap-3 mt-5">
                            <div>
                                <img src="/storage/fotos_perfil/{{$post->autor_imagen}}" style="width:40px;height: 40px;object-fit: cover">
                            </div>
                            
                            <div>
                                <p class="fw-bold my-0">{{$post->autor}}</p>
                                <p class="card-text"><small class="text-muted">{{$post->created_at->format('d')}} de {{$meses[(int)$post->created_at->format('m')-1]}} a las {{$post->created_at->format('H:i')}}</small></p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
    
    
    
@endsection

@section('js')
    <script src="{{asset('js/sweetAlert.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@endsection