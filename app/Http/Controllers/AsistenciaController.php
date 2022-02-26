<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistencias = Asistencia::select('asistencias.*','alumnos.apellido_paterno','alumnos.apellido_materno','alumnos.primer_nombre','alumnos.segundo_nombre','alumnos.dni','aulas.grado','aulas.nivel')
        ->leftjoin('alumnos', 'asistencias.id_alumno', '=', 'alumnos.id')
        ->leftjoin('aulas', 'alumnos.id_aula', '=', 'aulas.id')
        ->get();
        return view('admin.asistencia.index')->with('asistencias',$asistencias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        date_default_timezone_set("America/Lima");
        $fecha = date("d-m-Y"); 
        $fecha2 = date("Y-m-d");
        $asistencias = Asistencia::select('asistencias.*','alumnos.apellido_paterno','alumnos.apellido_materno','alumnos.primer_nombre','alumnos.segundo_nombre')
        ->leftjoin('alumnos', 'asistencias.id_alumno', '=', 'alumnos.id')
        ->whereDate('asistencias.created_at', $fecha2)
        ->get();
        return view('admin.asistencia.create')
            ->with('fecha',$fecha)
            ->with('asistencias', $asistencias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        date_default_timezone_set("America/Lima");
        $hora = date("H:i:s");
        $fecha = date("Y-m-d");
        $alumno = Alumno::select('*')->where('dni', $request->get('text'))->first();
        $registro = Asistencia::select('*')
            ->whereDate('created_at', $fecha)
            ->where('id_alumno', $alumno->id)
            ->count();
        
        if($registro == 0){
            $hora_puntual = strtotime( "08:00:00" );
            
            $asistencia = new Asistencia();
            $asistencia->id_alumno = $alumno->id;
            $asistencia->tipo = 'entrada';
            if($hora<$hora_puntual){
                $asistencia->estado = 'puntual';
            }
            else{
                $asistencia->estado = 'tardanza';
            }
            $asistencia->save();
            return redirect()
                ->route('asistencia.create')               
                ->with('success', 'Asistencia de '.$alumno->primer_nombre.' '.$alumno->apellido_paterno.' registrada exitosamente!');
        }else{
            return redirect()
                ->route('asistencia.create')
                ->with('error', 'La asistencia de '.$alumno->primer_nombre.' '.$alumno->apellido_paterno.' ya fué registrada!');
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
