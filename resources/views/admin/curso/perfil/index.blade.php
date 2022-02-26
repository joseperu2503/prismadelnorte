
@extends((auth()->user()->role == 'profesor') ? 'layouts.appProfesor' : 'layouts.appAdmin')

@section('title','Cursos')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.4/datatables.min.css"/>
@endsection

@section('content')

    <h1 class="titulo">{{$curso->nombre}} - {{$aula->grado}} de {{$aula->nivel}}</h1>
    <a href="/curso/{{$curso->id}}/agregar_notas" >
        <button class="boton btn-verde">Agregar Notas</button>
    </a>

    @foreach ($bimestres as $bimestre)
    <h2 class="titulo-2">{{$bimestre->bimestre}} Bimestre</h2>

    <div class="columnas">
        <table class="table notas">
            <thead>
                <tr>
                    <th >Alumno</th>
                </tr>
            </thead>           
            <tbody>
                    @foreach ($alumnos as $alumno)
                        <tr>
                            <td class="align-middle">
                                <div class="notas_span row align-items-center">
                                    {{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->primer_nombre}} {{$alumno->segundo_nombre}}
                                </div>    
                            </td>                                                   
                        </tr>                     
                    @endforeach  
                    <tr>
                        <td>
                            <div class="notas_span"></div>
                        </td>
                    </tr>                 
            </tbody>           	
        </table>
        @foreach ($evaluaciones as $evaluacion)
            @if ($evaluacion->id_bimestre == $bimestre->id)
                <table class="table notas">
                    <thead>
                        <tr>
                            <th >{{$evaluacion->evaluacion}} {{$evaluacion->num_evaluacion}}</th>
                        </tr>
                    </thead> 
                    <tbody>
                        @foreach ($notas as $nota)
                            <tr>
                                @if ($nota->id_evaluacion == $evaluacion->id_evaluacion && $nota->num_evaluacion == $evaluacion->num_evaluacion)
                                    <td class="align-middle">
                                        <div class="notas_span justify-content-center row align-items-center">
                                            {{$nota->nota}}
                                        </div>
                                    </td>
                                @endif     
                            </tr>          
                        @endforeach
                        <tr>
                            <td> 
                                <div class="notas_span justify-content-center row align-items-center">     
                                    <form title="Eliminar" action="/notas/destroy" method="post" class="formEliminar">
                                        <a href="/curso/{{$curso->id}}/{{$bimestre->id}}/{{$evaluacion->id_evaluacion}}/{{$evaluacion->num_evaluacion}}/editar_nota">                            
                                            <button type="button" class="boton btn-naranja btn-icon">
                                                <i class="fas fa-pen-square"></i>
                                            </button>                           
                                        </a>
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id_evaluacion" value="{{$evaluacion->id_evaluacion}}">
                                        <input type="hidden" name="num_evaluacion" value="{{$evaluacion->num_evaluacion}}">
                                        <input type="hidden" name="id_curso" value="{{$curso->id}}">
                                        <input type="hidden" name="id_bimestre" value="{{$evaluacion->id_bimestre}}">
                                        <button type="submit" class="boton btn-rojo btn-icon formEliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>                           
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody> 
                </table>
                
            @endif              
        @endforeach
       
    @endforeach  
@endsection

@section('js')
    <script src="{{asset('js/sweetAlert.js')}}"></script>
@endsection