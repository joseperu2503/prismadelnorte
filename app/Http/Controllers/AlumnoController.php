<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;
use App\Models\Alumno;
use App\Models\Bimestre;
use App\Models\Nota;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($aula_id)
    {
        $alumnos = Alumno::paginate();
        $aula = Aula::find($aula_id);
        return view('admin.alumno.index')->with('aula',$aula)->with('alumnos',$alumnos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $aula = Aula::find($id);
        return view('admin.alumno.create')->with('aula',$aula);
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
            'id_aula' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'genero' => 'required',
            'password' => 'required'
        ]);

        $alumnos = new Alumno();

        $alumnos->dni = $request->get('dni');
        $alumnos->primer_nombre = $request->get('primer_nombre');
        $alumnos->segundo_nombre = $request->get('segundo_nombre');
        $alumnos->apellido_paterno = $request->get('apellido_paterno');
        $alumnos->apellido_materno = $request->get('apellido_materno');
        $alumnos->id_aula = $request->get('id_aula');
        $alumnos->telefono = $request->get('telefono');
        $alumnos->email = $request->get('email');
        $alumnos->direccion = $request->get('direccion');
        $alumnos->foto_perfil = 'estudiante.png';
        $alumnos->genero = $request->get('genero');
        $alumnos->password = $request->get('password');
        $alumnos->save();

        $user = new User();
        $user->dni = $request->get('dni');
        $user->password = $request->get('password');
        $user->role = 'alumno';
        $user->save();

        return redirect('/alumnos/'.$request->get('id_aula'));
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
        $alumno = Alumno::find($id);
        return view('admin.alumno.edit')->with('alumno',$alumno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $request->validate([
            'dni' => 'required',
            'primer_nombre' => 'required',
            'segundo_nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'id_aula' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'genero' => 'required',
        ]);
        
        $alumno = Alumno::find($id);
        $alumno->update($request->all());

        return redirect('/alumnos/'.$request->get('id_aula'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno = Alumno::find($id);
        $alumno->delete();
        return redirect()->back();
    }

    public function index_usuario()
    {
        $dni = auth()->user()->dni;
        $alumno = DB::table('alumnos')->where('dni', $dni)->first();
        return view('admin.alumno.usuario.index')->with('alumno',$alumno);
    }

    public function perfil()
    {   
        $dni = auth()->user()->dni;
        $alumno = DB::table('alumnos')->where('dni', $dni)->first();
        $id_aula = $alumno->id_aula;
        $aula = DB::table('aulas')->where('id', $id_aula)->first();
        return view('admin.alumno.usuario.perfil')->with('alumno',$alumno)->with('aula',$aula);
    }

    public function update_foto(Request $request,$id)
    {   
        $dni = auth()->user()->dni;
        $alumno = DB::table('alumnos')->where('dni', $dni)->first();
        $id_aula = $alumno->id_aula;
        $aula = DB::table('aulas')->where('id', $id_aula)->first();

        if($imagen = $request->file('foto_perfil')){
        
            $rutaGuardarImg = 'storage/fotos_perfil/';
            $imagenAlumno = $imagen->getClientOriginalName(); 
            $imagen->move($rutaGuardarImg, $imagenAlumno);
            $alum = Alumno::find($id);
            $alum->foto_perfil = $imagenAlumno ;
            $alum->save();
        
            return redirect()->route('alumno.usuario.perfil');
        }else{
            return redirect()->route('alumno.usuario.perfil');
        }           
    }

    public function cursos()
    {   
        $dni = auth()->user()->dni;
        $alumno = DB::table('alumnos')->where('dni', $dni)->first();
        $id_aula = $alumno->id_aula;
        $cursos = DB::table('cursos')->where('id_aula', $id_aula)->get();
        return view('admin.alumno.usuario.cursos')->with('cursos',$cursos)->with('alumno',$alumno);
    }

    public function curso($codigo)
    {   
        $dni = auth()->user()->dni;
        $alumno = DB::table('alumnos')->where('dni', $dni)->first();
        $curso = DB::table('cursos')->where('codigo', $codigo)->first();
        $bimestres = Bimestre::select('*')                      
            ->get();
        $notas = Nota::select('notas.*','evaluacions.evaluacion')    
            ->leftjoin('evaluacions', 'notas.id_evaluacion', '=', 'evaluacions.id')                
            ->where('id_curso', $curso->id)
            ->where('id_alumno', $alumno->id)
            ->get();
        return view('admin.alumno.usuario.curso')->with('curso',$curso)
            ->with('alumno',$alumno)
            ->with('bimestres',$bimestres)
            ->with('notas',$notas);
    }
    
}
