<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Aula;
use App\Models\Bimestre;
use App\Models\Curso;
use App\Models\Evaluacion;
use App\Models\Nota;
use App\Models\Profesor;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $curso = Curso::find($id);
        $id_profesor = Curso::select('*')           
            ->where('id_profesor', $curso->id_profesor)
            ->first()->id_profesor;
        $profesor = Profesor::select('*')           
            ->where('id', $id_profesor)
            ->first();
        $aula = Aula::select('*')           
            ->where('id', $curso->id_aula)
            ->first();
        $bimestres = Bimestre::select('*')                      
            ->get();
        $evaluaciones = Evaluacion::select('*')                      
            ->get();
        $alumnos = Alumno::select('*')   
            ->where('id_aula', $aula->id)  
            ->orderBy('apellido_paterno', 'asc')                 
            ->get();
        return view('admin.nota.create')
            ->with('curso',$curso)
            ->with('profesor',$profesor)
            ->with('aula',$aula)
            ->with('bimestres',$bimestres)
            ->with('evaluaciones',$evaluaciones)
            ->with('alumnos',$alumnos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $count = Nota::select('*')           
            ->where('id_bimestre', $request->get('id_bimestre'))
            ->where('id_evaluacion', $request->get('id_evaluacion'))
            ->where('num_evaluacion', $request->get('num_evaluacion'))
            ->where('id_curso', $id)
            ->count();  

        if($count > 0){
            return redirect()->back()->withErrors(
                ['message' =>'La evaluacion ingresada ya existe, verfique y vuelva a intentar.']
            )->withInput();
        }
        else {
            $curso = Curso::find($id);
            $aula = Aula::select('*')           
                ->where('id', $curso->id_aula)
                ->first();
            $alumnos = Alumno::select('*')   
                ->where('id_aula', $aula->id)                   
                ->get();
    
            foreach($alumnos as $alumno){
                $nota = new Nota();
                $nota->id_curso = $id;
                $nota->id_bimestre = $request->get('id_bimestre');
                $nota->id_evaluacion = $request->get('id_evaluacion');
                $nota->num_evaluacion = $request->get('num_evaluacion');
                $nota->id_alumno = $alumno->id;
                $nota->nota = $request->get('nota_'.$alumno->id);            
                $nota->save();
            }
    
            return redirect()->route('curso.perfil',$id);
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
    public function edit($id_curso,$id_bimestre,$id_evaluacion,$num_evaluacion)
    {
        $curso = Curso::find($id_curso);
        $id_profesor = Curso::select('*')           
            ->where('id_profesor', $curso->id_profesor)
            ->first()->id_profesor;
        $profesor = Profesor::select('*')           
            ->where('id', $id_profesor)
            ->first();
        $aula = Aula::select('*')           
            ->where('id', $curso->id_aula)
            ->first();
        $bimestres = Bimestre::select('*')                      
            ->get();
        $evaluaciones = Evaluacion::select('*')                      
            ->get();
        $notas = Nota::select('*')                    
            ->where('id_evaluacion', $id_evaluacion)
            ->where('num_evaluacion', $num_evaluacion)
            ->where('id_curso', $id_curso)
            ->where('id_bimestre', $id_bimestre)
            ->get();
        $alumnos = Alumno::select('*')   
            ->where('id_aula', $aula->id)    
            ->orderBy('apellido_paterno', 'asc')               
            ->get();
        $evaluacion_datos = Nota::select('*')                    
            ->where('id_evaluacion', $id_evaluacion)
            ->where('num_evaluacion', $num_evaluacion)
            ->where('id_curso', $id_curso)
            ->where('id_bimestre', $id_bimestre)
            ->first();
        return view('admin.nota.edit')
            ->with('curso',$curso)
            ->with('aula',$aula)
            ->with('profesor',$profesor)
            ->with('bimestres',$bimestres)
            ->with('evaluaciones',$evaluaciones)
            ->with('notas',$notas)
            ->with('alumnos',$alumnos)
            ->with('evaluacion_datos',$evaluacion_datos);
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

        $count = Nota::select('*')           
            ->where('id_bimestre', $request->get('id_bimestre'))
            ->where('id_evaluacion', $request->get('id_evaluacion'))
            ->where('num_evaluacion', $request->get('num_evaluacion'))
            ->where('id_curso', $id)
            ->count();
        if($count == 0 || ($request->get('id_evaluacion_antiguo')==$request->get('id_evaluacion') &&
                            $request->get('num_evaluacion_antiguo')== $request->get('num_evaluacion') &&
                            $request->get('id_bimestre_antiguo')==$request->get('id_bimestre')) ){
            $curso = Curso::find($id);
            $aula = Aula::select('*')           
                ->where('id', $curso->id_aula)
                ->first();
            $alumnos = Alumno::select('*')   
                ->where('id_aula', $aula->id)                   
                ->get();

            foreach($alumnos as $alumno){

                $nota = Nota::select('*')                    
                ->where('id_evaluacion', $request->get('id_evaluacion_antiguo'))
                ->where('num_evaluacion', $request->get('num_evaluacion_antiguo'))
                ->where('id_curso', $request->get('id_curso_antiguo'))
                ->where('id_bimestre', $request->get('id_bimestre_antiguo'))
                ->where('id_alumno', $alumno->id)
                ->first();

                $nota->id_curso = $id;
                $nota->id_bimestre = $request->get('id_bimestre');
                $nota->id_evaluacion = $request->get('id_evaluacion');
                $nota->num_evaluacion = $request->get('num_evaluacion');
                $nota->id_alumno = $alumno->id;
                $nota->nota = $request->get('nota_'.$alumno->id);            
                $nota->save();
            }
            return redirect()->route('curso.perfil',$id);
        }
        else {    
            return redirect('/curso/'.$id.'/'. $request->get('id_bimestre_antiguo').'/'.$request->get('id_evaluacion_antiguo').'/'.$request->get('num_evaluacion_antiguo').'/editar_nota')
            ->withErrors(
                ['message' =>'La evaluacion ingresada ya existe, verfique y vuelva a modificar los datos.']
            )->withInput();
        }       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $evaluaciones = Nota::select('*')                    
            ->where('id_evaluacion', $request->get('id_evaluacion'))
            ->where('num_evaluacion', $request->get('num_evaluacion'))
            ->where('id_curso', $request->get('id_curso'))
            ->where('id_bimestre', $request->get('id_bimestre'))
            ->get();

        foreach($evaluaciones as $evaluacion){
            $evaluacion->delete();
        }
        

        return redirect()->back();
    }
}
