<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Models\Profesor;
use Illuminate\Support\Facades\DB;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesores = Profesor::all();
        return view('admin.profesor.index')->with('profesores',$profesores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profesor.create');
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
            'dni' => 'required',
            'primer_nombre' => 'required',
            'segundo_nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'genero' => 'required'
        ]);

        $profesor = $request->all();       
        Profesor::create($profesor);
        return redirect()->route('profesores.index');
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
        $profesor = Profesor::find($id);
        return view('admin.profesor.edit')->with('profesor',$profesor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'dni' => 'required',
            'primer_nombre' => 'required',
            'segundo_nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'genero' => 'required',
        ]);

        $profesor = Profesor::find($id);
        $profesor->update($request->all());
        return redirect()->route('profesores.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profesor = Profesor::find($id);
        $profesor->delete();
        return redirect()->back();
    }

    public function perfil($id)
    {
        $profesor = Profesor::find($id);
        return view('admin.profesor.perfil.index')->with('profesor',$profesor);
    }

    public function cursos($id)
    {   
        $profesor = Profesor::find($id);       
        $cursos = Curso::select('cursos.*','profesors.primer_nombre','profesors.apellido_paterno','aulas.grado','aulas.nivel')
            ->leftjoin('aulas', 'cursos.id_aula', '=', 'aulas.id')
            ->leftjoin('profesors', 'cursos.id_profesor', '=', 'profesors.id')
            ->where('id_profesor', $id)
            ->get();
        
        return view('admin.profesor.perfil.cursos')->with('profesor',$profesor)->with('cursos',$cursos);
    }

    public function index_usuario()
    {
        $dni = auth()->user()->dni;
        $profesor = DB::table('profesors')->where('dni', $dni)->first();
        return view('admin.profesor.perfil.index')->with('profesor',$profesor);
    }

    public function cursos_usuario()
    {
        $dni = auth()->user()->dni;
        $profesor = DB::table('profesors')->where('dni', $dni)->first();       
        $cursos = Curso::select('cursos.*','profesors.primer_nombre','profesors.apellido_paterno','aulas.grado','aulas.nivel')
            ->leftjoin('aulas', 'cursos.id_aula', '=', 'aulas.id')
            ->leftjoin('profesors', 'cursos.id_profesor', '=', 'profesors.id')
            ->where('id_profesor', $profesor->id)
            ->get();
        return view('admin.profesor.perfil.cursos')->with('profesor',$profesor)->with('cursos',$cursos);
    }



}
