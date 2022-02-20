@extends('layouts.appAdmin')

@section('title','Aulas')

@section('content')
    <h1 class="text-5xl text-center pt-24">Aulas</h1>
    <a href="aulas/create" class="btn btn-primary">Nuevo</a>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Código</th>
                <th scope="col">Grado y Nivel</th>
                <th scope="col">Abreviatura</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aulas as $aula)
                <tr>
                    <td>{{$aula->id}}</td>
                    <td>{{$aula->codigo}}</td>
                    <td>{{$aula->grado}} de {{$aula->nivel}}</td>
                    <td>{{$aula->abreviatura}}</td>
                    <td>                     
                        <form action="{{route('aulas.destroy',$aula->id)}}" method="POST">
                            <a class="btn btn-success" href="/aulas/{{$aula->id}}/edit">Entrar</a>
                            <a class="btn btn-warning" href="/aulas/{{$aula->id}}/edit">Editar</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection