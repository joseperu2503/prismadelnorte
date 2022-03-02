<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;
use App\Models\Alumno;
use App\Models\Asistencia;
use App\Models\Bimestre;
use App\Models\Genero;
use App\Models\Grado;
use App\Models\Nota;
use App\Models\Post;
use App\Models\Profesor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $grados = Grado::all();
        $generos = Genero::all();
        return view('admin.alumno.create')->with('aula',$aula)->with('grados',$grados)->with('generos',$generos);
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
            'dni' => 'required|numeric|digits:8',
            'dni_padre' => 'numeric|digits:8',
            'dni_madre' => 'numeric|digits:8',
            'dni_apoderado' => 'numeric|digits:8',
            'primer_nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'id_aula' => 'required',
            'id_grado' => 'required',
            'id_genero' => 'required',
            'password' => 'required'
        ]);

        Alumno::create([
            'foto_perfil' => '/storage/fotos_perfil/estudiante.png'
        ]+$request->all());
    

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
        $aulas = Aula::all();
        $grados = Grado::all();
        $generos = Genero::all();
        return view('admin.alumno.edit')->with('alumno',$alumno)->with('aulas',$aulas)->with('grados',$grados)->with('generos',$generos);      
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
            'dni' => 'required|numeric|digits:8',
            'dni_padre' => 'numeric|digits:8',
            'dni_madre' => 'numeric|digits:8',
            'dni_apoderado' => 'numeric|digits:8',
            'primer_nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'id_aula' => 'required',
            'id_grado' => 'required',
            'id_genero' => 'required'
        ]);
        
        $alumno = Alumno::find($id);
       
        if($request->get('password')!='' || $request->get('dni') != $alumno->dni){
            $user = User::select('*')->where('dni', $alumno->dni)->first();
            if($request->get('dni') != $alumno->dni){
                $user->dni = $request->get('dni') ;
            }          
            if($request->get('password')!=''){
                $user->password = $request->get('password') ;
            }
            $user->save();
        }
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
        $user = User::select('*')->where('dni', $alumno->dni)->first();
        $user->delete();
        $alumno->delete();
        return redirect()->back();
    }

    public function index_usuario()
    {
        $dni = auth()->user()->dni;
        $alumno = DB::table('alumnos')->where('dni', $dni)->first();
        $posts = Post::select('posts.*','users.dni','users.role')
        ->leftjoin('users', 'posts.id_user', '=', 'users.id')
        ->orderby('created_at','desc')
        ->get();
        foreach($posts as $post){
            if($post->role=='profesor'){
                $profesor=Profesor::select('*')
                    ->where('dni',$post->dni)
                    ->first();
                $post['autor']=$profesor->primer_nombre." ".$profesor->apellido_paterno;
                $post['autor_imagen']=$profesor->foto_perfil;
            }
            else if($post->role=='admin'){
                $post['autor']='Administración';
                $post['autor_imagen']='logo.png';
            }

        }  
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return view('admin.alumno.usuario.index')->with('alumno',$alumno)->with('posts',$posts)->with('meses',$meses);
    }

    public function perfil_usuario()
    {   
        $dni = auth()->user()->dni;
        $alumno = DB::table('alumnos')->where('dni', $dni)->first();
        $id_aula = $alumno->id_aula;
        $aula = DB::table('aulas')->where('id', $id_aula)->first();
        return view('admin.alumno.usuario.perfil')->with('alumno',$alumno)->with('aula',$aula);
    }

    public function update_foto(Request $request,$id)
    {   

        $request->validate([
            'foto_perfil' => 'image|mimes:jpeg,png,jpg'
        ]);
        $alumno = Alumno::find($id);
        if($imagen = $request->file('foto_perfil')) {         
            $nombre_img = date('YmdHis'). "." . $request->file('foto_perfil')->getClientOriginalExtension();
            $imagen = $request->file('foto_perfil')->storeAs('fotos_perfil',$nombre_img,'public');
            $datos['foto_perfil'] = Storage::url($imagen);
            if($alumno->foto_perfil != '/storage/fotos_perfil/estudiante.png'){
                Storage::delete(str_replace("storage", "public", $alumno->foto_perfil)); 
            }
            $alumno->update($datos);         
        }
        return redirect()->route('alumno.usuario.perfil');
                  
    }

    public function cursos_usuario()
    {   
        $dni = auth()->user()->dni;
        $alumno = DB::table('alumnos')->where('dni', $dni)->first();
        $id_aula = $alumno->id_aula;
        $cursos = DB::table('cursos')->where('id_aula', $id_aula)->get();
        return view('admin.alumno.usuario.cursos')->with('cursos',$cursos)->with('alumno',$alumno);
    }

    public function curso_usuario($codigo)
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

    public function asistencia_usuario()
    {   
        $dni = auth()->user()->dni;
        $alumno = DB::table('alumnos')->where('dni', $dni)->first();
        $asistencias = Asistencia::select('*')                  
            ->where('id_alumno', $alumno->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.alumno.usuario.asistencia')->with('asistencias',$asistencias)->with('alumno',$alumno);
    }
    
}
