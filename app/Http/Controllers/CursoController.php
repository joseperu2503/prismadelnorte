<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Aula;
use App\Models\Nota;
use App\Models\Profesor;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $cursos = Curso::select('cursos.*','profesors.primer_nombre','profesors.apellido_paterno','aulas.grado','aulas.nivel')
            ->leftjoin('aulas', 'cursos.id_aula', '=', 'aulas.id')
            ->leftjoin('profesors', 'cursos.id_profesor', '=', 'profesors.id')
            ->get();
        return view('admin.curso.index')->with('cursos',$cursos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        $profesores = Profesor::all();
        $aulas = Aula::all();
        return view('admin.curso.create')->with('aulas',$aulas)->with('profesores',$profesores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            'nombre' => 'required',
            'id_aula' => 'required',
            'id_profesor' => 'required',
        ]);

        $curso = $request->all();       
        Curso::create($curso);
        return redirect()->route('cursos.index');
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
        $profesores = Profesor::all();
        $aulas = Aula::all();
        $curso = Curso::find($id);
        return view('admin.curso.edit')->with('curso',$curso)->with('aulas',$aulas)->with('profesores',$profesores);
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
        $request->validate([
            'codigo' => 'required',
            'nombre' => 'required',
            'id_aula' => 'required',
            'id_profesor' => 'required',
        ]);

        $curso = Curso::find($id);
        $curso->update($request->all());
        return redirect()->route('cursos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso::find($id);
        $curso->delete();
        return redirect()->back();
    }

    public function perfil($id)
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
        $bimestres = Nota::select('bimestres.bimestre','bimestres.id')   
            ->leftjoin('bimestres', 'notas.id_bimestre', '=', 'bimestres.id')        
            ->where('id_curso', $id)
            ->distinct()
            ->get();
        $alumnos = Alumno::select('*') 
            ->where('id_aula', $aula->id)
            ->orderBy('apellido_paterno', 'asc')
            ->get();
        $evaluaciones = Nota::select('evaluacions.evaluacion','notas.num_evaluacion','notas.id_evaluacion','notas.id_bimestre')   
            ->leftjoin('evaluacions', 'notas.id_evaluacion', '=', 'evaluacions.id')        
            ->where('id_curso', $id)
            ->distinct()
            ->get();
        $notas = Nota::select('notas.*','alumnos.apellido_paterno')   
            ->leftjoin('alumnos', 'notas.id_alumno', '=', 'alumnos.id')
            ->where('id_curso', $id)
            ->orderBy('alumnos.apellido_paterno', 'asc')
            ->get();
        return view('admin.curso.perfil.index')
            ->with('curso',$curso)
            ->with('profesor',$profesor)
            ->with('aula',$aula)
            ->with('bimestres',$bimestres)
            ->with('alumnos',$alumnos)
            ->with('evaluaciones',$evaluaciones)
            ->with('notas',$notas);
    }

}