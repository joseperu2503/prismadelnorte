@extends('layouts.appAlumno')

@section('title','Mis notas - '.$curso->nombre)

@section('content')

    <h1 class="titulo">{{$curso->nombre}}</h1>

    @foreach ($bimestres as $bimestre)
    <button name='select-container' class='bimestre-container' id="boton_{{$bimestre->bimestre}}">
        <p>{{$bimestre->bimestre}} Bimestre</p>				
        <i class='fas fa-angle-down'></i>
    </button>
    @if ($notas->where('id_bimestre', $bimestre->id)->count()>0)
        <div class = "tabla-grid tabla-2 @if ($bimestre->bimestre=='Primer')
            visible
        @endif "        
        id="{{$bimestre->bimestre}}"
        >
            <div class = "table-header-left">Evaluacion</div>
            <div class = "table-header-right">Nota</div>
            @foreach ($notas as $nota) 
                @if ($nota->id_bimestre == $bimestre->id)
                    <div class = "table-body">{{$nota->evaluacion}} {{$nota->num_evaluacion}}</div>
                    <div class = "table-body">
                        @if ($nota->nota>10)
                            <p class = "nota-aprobada">{{$nota->nota}}</p> 
                        @else
                            <p class = "nota-desaprobada">{{$nota->nota}}</p>   
                        @endif                   
                    </div>
                @endif         
            @endforeach		
        </div>
    @else
        <div class = "sin_notas @if($bimestre->bimestre=='Primer') visible @endif" id="{{$bimestre->bimestre}}">Aun no hay notas disponibles</div>       
    @endif
            
    @endforeach
    <script>
        //Ejecutar función en el evento click
        document.getElementById("boton_Primer").addEventListener("click", open_primer_bimestre);
        document.getElementById("boton_Segundo").addEventListener("click", open_segundo_bimestre);
        document.getElementById("boton_Tercer").addEventListener("click", open_tercer_bimestre);
        document.getElementById("boton_Cuarto").addEventListener("click", open_cuarto_bimestre);
    
        //Declaramos variables
    
        var primer = document.getElementById("Primer");
        var segundo = document.getElementById("Segundo");
        var tercer = document.getElementById("Tercer");
        var cuarto = document.getElementById("Cuarto");
    
        function open_primer_bimestre(){  
            segundo.classList.remove("visible");
            tercer.classList.remove("visible");
            cuarto.classList.remove("visible"); 
            primer.classList.add("visible");   
        }
        function open_segundo_bimestre(){
            primer.classList.remove("visible");   
            tercer.classList.remove("visible");
            cuarto.classList.remove("visible");
            segundo.classList.add("visible");   
        }
        function open_tercer_bimestre(){
            primer.classList.remove("visible");
            segundo.classList.remove("visible"); 
            cuarto.classList.remove("visible");
            tercer.classList.add("visible");       
        }
        function open_cuarto_bimestre(){
            primer.classList.remove("visible");
            segundo.classList.remove("visible");
            tercer.classList.remove("visible");
            cuarto.classList.add("visible");       
        }
    </script>
@endsection

