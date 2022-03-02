<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $table = 'cursos';
    protected $fillable = [
        'codigo',
        'nombre',
        'id_aula',
        'id_profesor'
    ];

    public function profesor(){
        return $this->belongsTo(Profesor::class,'id_profesor');
    }

    public function aula(){
        return $this->belongsTo(Aula::class,'id_aula');
    }
}
