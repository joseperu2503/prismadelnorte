<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $table = 'alumnos';
    protected $fillable = [
        'dni',
        'primer_nombre',
        'segundo_nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'email',
        'direccion',
        'foto_perfil',
        'genero',
        'password',
        'id_aula'
    ];

    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }
}
