@extends((auth()->user()->role == 'profesor') ? 'layouts.appProfesor' : 'layouts.appAdmin')

@section('title','Cursos')

@section('content')

    <h1 class="titulo">{{$curso->nombre}} - {{$aula->grado}} de {{$aula->nivel}}</h1>
    
    <div class="editar-notas-container">
        <h2 class="agregar-notas">Editar Notas</h2>    
    </div>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                - {{ $error }} <br />
            @endforeach
        </div>
    @endif
    <form action="/curso/{{$curso->id}}/update" method="post" class="form-notas">
        @csrf
        @method('PUT')   
        <div class="tipo_evaluacion">
            <div class="select-container">
                <select name="id_bimestre" class="input-formulario select-form" required>
                    <option selected disabled value="">Seleccione una opción</option>
                    @foreach ($bimestres as $bimestre)
                        @if ($evaluacion_datos->id_bimestre == $bimestre->id)
                            <option selected value="{{$bimestre->id}}">{{$bimestre->bimestre}} Bimestre</option>
                        @else
                            <option value="{{$bimestre->id}}">{{$bimestre->bimestre}} Bimestre</option>
                        @endif
                        
                    @endforeach                                     
                </select>
                <i class="fas fa-angle-down"></i>
            </div>
            <div class="select-container">
                <select name="id_evaluacion" class="input-formulario select-form" required>
                    <option selected disabled value="">Seleccione una opción</option>
                    @foreach ($evaluaciones as $evaluacion)
                        @if ($evaluacion_datos->id_evaluacion == $evaluacion->id)
                            <option selected value="{{$evaluacion->id}}">{{$evaluacion->evaluacion}}</option>
                        @else
                            <option value="{{$evaluacion->id}}">{{$evaluacion->evaluacion}}</option>
                        @endif                       
                    @endforeach                                     
                </select>
                <i class="fas fa-angle-down"></i>
            </div>            
            <label class="form-label">Numero de evaluacion</label>
            <input id="num_evaluacion" name="num_evaluacion" type="number" class="input-formulario" value="{{$evaluacion_datos->num_evaluacion}}" required>                  
        </div>
        
        <div class = "tabla-grid tabla-3">
            <div class = "table-header-left">Foto</div>
            <div class = "table-header-center">Apellidos y nombres</div>
            <div class = "table-header-right">Nota</div>		
            @foreach ($alumnos as $alumno)                         
                <div class = "table-body">
                    <img class = "foto" src="/storage/fotos_perfil/{{$alumno->foto_perfil}}" alt="">
                </div>	
                <div class = "table-body">{{$alumno->apellido_paterno}} {{$alumno->apellido_materno}} {{$alumno->primer_nombre}} {{$alumno->segundo_nombre}}</div>
                @foreach ($notas as $nota)
                    @if ($nota->id_alumno == $alumno->id)
                        <div class = "table-body">
                            <input type="text" class="input-formulario" name="nota_{{$alumno->id}}" placeholder="Insertar" value="{{$nota->nota}}" required>         
                        </div>
                    @endif 
                @endforeach               	
            @endforeach
        </div>
        <div class="buttons-form"> 
            <a href="/curso/{{$curso->id}}" tabindex="5">
                <button type="button" class="cancelar" >Cancelar</button>
            </a>       
            <input type="submit" class = "hecho" value = "Enviar">
        </div>
        <input type="hidden" name="id_evaluacion_antiguo" value="{{$evaluacion_datos->id_evaluacion}}">
        <input type="hidden" name="num_evaluacion_antiguo" value="{{$evaluacion_datos->num_evaluacion}}">
        <input type="hidden" name="id_curso_antiguo" value="{{$evaluacion_datos->id_curso}}">
        <input type="hidden" name="id_bimestre_antiguo" value="{{$evaluacion_datos->id_bimestre}}">
    </form>

    
@endsection