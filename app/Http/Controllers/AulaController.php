<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $aulas = Aula::all();
        return view('admin.aula.index')->with('aulas',$aulas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.aula.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aulas = new Aula();

        $aulas->codigo = $request->get('codigo');
        $aulas->grado = $request->get('grado');
        $aulas->nivel = $request->get('nivel');
        $aulas->abreviatura = $request->get('abreviatura');

        $aulas->save();

        return redirect('/aulas');
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
        $aula = Aula::find($id);
        return view('admin.aula.edit')->with('aula',$aula);
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
        $aula = Aula::find($id);

        $aula->codigo = $request->get('codigo');
        $aula->grado = $request->get('grado');
        $aula->nivel = $request->get('nivel');
        $aula->abreviatura = $request->get('abreviatura');

        $aula->save();

        return redirect('/aulas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aula = Aula::find($id);
        $aula->delete();

        return redirect('/aulas');
    }
}
