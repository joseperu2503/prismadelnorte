<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
date_default_timezone_set("America/Lima");
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        return view('admin.post.index')->with('posts',$posts)->with('meses',$meses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
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
            'imagen' => 'image|mimes:jpeg,png,jpg'
        ]);

        $post=Post::create([
            'id_user' => auth()->user()->id,
            'ventana' => '1',
            'noticia' => '1'
        ]+$request->all());

        if($request->file('imagen')) {
            // $rutaGuardarImg = 'storage/imagenes_post/';
            // $imagenPost = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            // $imagen->move($rutaGuardarImg, $imagenPost);
            // $post['imagen'] = "$imagenPost";       
            $nombre_img = date('YmdHis'). "." . $request->file('imagen')->getClientOriginalExtension();
            $imagen = $request->file('imagen')->storeAs('imagenes_post',$nombre_img,'public');
            $post->imagen = Storage::url($imagen);
            $post->save();
        }
             
        return redirect()->route('publicaciones.index');
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
        $post = Post::find($id);
        return view('admin.post.edit')->with('post',$post);
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
            'imagen' => 'image|mimes:jpeg,png,jpg'
        ]);
        $datos = $request->all();
        $post = Post::find($id);
        if($imagen = $request->file('imagen')) {         
            $nombre_img = date('YmdHis'). "." . $request->file('imagen')->getClientOriginalExtension();
            $imagen = $request->file('imagen')->storeAs('imagenes_post',$nombre_img,'public');
            $datos['imagen'] = Storage::url($imagen);
            Storage::delete(str_replace("storage", "public", $post->imagen)); 
        }
        $post->update($datos);
        return redirect()->route('publicaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        Storage::delete(str_replace("storage", "public", $post->imagen)); 
        $post->delete();  
        return redirect()->route('publicaciones.index');
    }
}
