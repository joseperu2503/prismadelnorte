<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionsController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(){
        if(auth()->attempt(request(['dni', 'password'])) == false){
            return back()->withErrors(
                ['message' =>'El DNI o la contraseña es incorrecta.']
            );
        }else{
            if(auth()->user()->role == 'admin'){
                return redirect()->route('admin.index');
            }
            else if(auth()->user()->role == 'alumno') {
                return redirect()->route('alumno.usuario.index');
            }
            else if(auth()->user()->role == 'profesor'){
                return redirect()->route('profesor.usuario.index');
            }
            else {
                return redirect()->to('/');
            }
        }
        
    }

    public function destroy(){
        auth()->logout();
        return redirect()->to('/');
    }
}
