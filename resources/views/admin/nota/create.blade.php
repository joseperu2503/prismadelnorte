@extends((auth()->user()->role == 'profesor') ? 'layouts.appProfesor' : 'layouts.appAdmin')

@section('title','Cursos')

@section('content')

    <h1 class="titulo">{{$curso->nombre}} - {{$aula->grado}} de {{$aula->nivel}}</h1>
    
    <div class="agregar-notas-container">
        <h2 class="agregar-notas">Agregar Notas</h2>
    </div>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                - {{ $error }} <br />
            @endforeach
        </div>
    @endif  
    <form action="/curso/{{$curso->id}}/store" method="post" class="form-notas">
        @csrf
        @method('PUT')         
        <div class="tipo_evaluacion">
            <label class="form-label">Bimestre</label>
            <div class="select-container">
                <select name="id_bimestre" class="input-formulario select-form" required>
                    <option selected disabled value="">Seleccione una opción</option>
                    @foreach ($bimestres as $bimestre)
                        <option @if (old('id_bimestre') == $bimestre->id)
                            selected
                        @endif value="{{$bimestre->id}}">{{$bimestre->bimestre}} Bimestre</option>
                    @endforeach                                     
                </select>
                <i class="fas fa-angle-down"></i>
            </div>
            <label class="form-label">Tipo de evaluación</label>
            <div class="select-container">
                <select name="id_evaluacion" class="input-formulario select-form" required>
                    <option selected disabled value="">Seleccione una opción</option>
                    @foreach ($evaluaciones as $evaluacion)
                        <option @if (old('id_evaluacion') == $evaluacion->id)
                            selected
                        @endif value="{{$evaluacion->id}}">{{$evaluacion->evaluacion}}</option>
                    @endforeach                                     
                </select>
                <i class="fas fa-angle-down"></i>
            </div>            
            <label class="form-label">Numero de evaluación</label>
            <input id="num_evaluacion" name="num_evaluacion" type="number" class="input-formulario" value="{{old('num_evaluacion')}}" required>                  
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
                <div class = "table-body">
                    <input type="text" class="input-formulario" name="nota_{{$alumno->id}}" placeholder="Insertar" required value="{{old('nota_'.$alumno->id)}}">         
                </div>	
            @endforeach
        </div>
        <div class="buttons-form"> 
            <a href="/curso/{{$curso->id}}" tabindex="5">
                <button type="button" class="cancelar" >Cancelar</button>
            </a>       
            <input type="submit" class = "hecho" value = "Enviar">
        </div>
        <input name="id_curso" type="hidden" value="{{$curso->id}}">
    </form>

    
@endsection