<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Aula;
use App\Models\Alumno;
use App\Models\Bimestre;
use App\Models\Profesor;
use App\Models\Curso;
use App\Models\Evaluacion;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new User;
        $user->dni = '74706220';
        $user->password = 'pegi';
        $user->role = 'admin';
        $user->save();


        $aula = new Aula;
        $aula->codigo = '01PRIM';
        $aula->grado = 'primer grado';
        $aula->nivel = 'primaria';
        $aula->abreviatura = '1°';

        $aula->save();

        $aula = new Aula;
        $aula->codigo = '02PRIM';
        $aula->grado = 'segundo grado';
        $aula->nivel = 'primaria';
        $aula->abreviatura = '2°';

        $aula->save();

        $aula = new Aula;
        $aula->codigo = '03PRIM';
        $aula->grado = 'tercer grado';
        $aula->nivel = 'primaria';
        $aula->abreviatura = '3°';

        $aula->save();

        $aula = new Aula;
        $aula->codigo = '04PRIM';
        $aula->grado = 'cuarto grado';
        $aula->nivel = 'primaria';
        $aula->abreviatura = '4°';

        $aula->save();
        $aula = new Aula;
        $aula->codigo = '05PRIM';
        $aula->grado = 'quinto grado';
        $aula->nivel = 'primaria';
        $aula->abreviatura = '5°';

        $aula->save();

        $aula = new Aula;
        $aula->codigo = '06PRIM';
        $aula->grado = 'sexto grado';
        $aula->nivel = 'primaria';
        $aula->abreviatura = '6°';

        $aula->save();
        $aula = new Aula;
        $aula->codigo = '01SEC';
        $aula->grado = 'primer año';
        $aula->nivel = 'secundaria';
        $aula->abreviatura = '1°';

        $aula->save();

        $aula = new Aula;
        $aula->codigo = '02SEC';
        $aula->grado = 'segundo año';
        $aula->nivel = 'secundaria';
        $aula->abreviatura = '2°';

        $aula->save();

        $aula = new Aula;
        $aula->codigo = '03SEC';
        $aula->grado = 'tercer año';
        $aula->nivel = 'secundaria';
        $aula->abreviatura = '3°';

        $aula->save();

        $aula = new Aula;
        $aula->codigo = '04SEC';
        $aula->grado = 'cuarto año';
        $aula->nivel = 'secundaria';
        $aula->abreviatura = '4°';

        $aula->save();

        $aula = new Aula;
        $aula->codigo = '05SEC';
        $aula->grado = 'quinto año';
        $aula->nivel = 'secundaria';
        $aula->abreviatura = '5°';

        $aula->save();

        $alumno = new Alumno;
        $alumno->dni = '12345678';
        $alumno->primer_nombre = 'Andres';
        $alumno->segundo_nombre = 'Rafael';
        $alumno->apellido_paterno = 'Martinez';
        $alumno->apellido_materno = 'Cerron';
        $alumno->id_aula = '6';
        $alumno->telefono = '993689145';
        $alumno->email = 'joseperu2503@gmail.com';
        $alumno->direccion = 'al costado de la panaderia';
        $alumno->foto_perfil = 'estudiante.png';
        $alumno->genero = 'masculino';
        $alumno->password = 'rama';
        $alumno->save();

        $alumno = new Alumno;
        $alumno->dni = '58274881';
        $alumno->primer_nombre = 'Juan';
        $alumno->segundo_nombre = 'Piero';
        $alumno->apellido_paterno = 'Martinez';
        $alumno->apellido_materno = 'Medina';
        $alumno->id_aula = '6';
        $alumno->telefono = '993689145';
        $alumno->email = 'joseperu2503@gmail.com';
        $alumno->direccion = 'al costado de la panaderia';
        $alumno->foto_perfil = 'estudiante.png';
        $alumno->genero = 'masculino';
        $alumno->password = 'mame';
        $alumno->save();

        $alumno = new Alumno;
        $alumno->dni = '78945623';
        $alumno->primer_nombre = 'Raul';
        $alumno->segundo_nombre = 'Marti';
        $alumno->apellido_paterno = 'Perez';
        $alumno->apellido_materno = 'Ramirez';
        $alumno->id_aula = '6';
        $alumno->telefono = '993689145';
        $alumno->email = 'joseperu2503@gmail.com';
        $alumno->direccion = 'al costado de la panaderia';
        $alumno->foto_perfil = 'estudiante.png';
        $alumno->genero = 'masculino';
        $alumno->password = 'pera';
        $alumno->save();

        $user = new User;
        $user->dni = '12345678';
        $user->password = 'rama';
        $user->role = 'alumno';
        $user->save();

        $user = new User;
        $user->dni = '58274881';
        $user->password = 'mame';
        $user->role = 'alumno';
        $user->save();

        $user = new User;
        $user->dni = '78945623';
        $user->password = 'pera';
        $user->role = 'alumno';
        $user->save();

        $profesor = new Profesor;
        $profesor->dni = '45978632';
        $profesor->primer_nombre = 'Jose';
        $profesor->segundo_nombre = 'Manuel';
        $profesor->apellido_paterno = 'Martinez';
        $profesor->apellido_materno = 'Lopez';
        $profesor->telefono = '993689145';
        $profesor->email = 'joseperu2503@gmail.com';
        $profesor->direccion = 'al costado de la panaderia';
        $profesor->genero = 'masculino';
        $profesor->foto_perfil = 'man.png';
        $profesor->save();

        $user = new User;
        $user->dni = '45978632';
        $user->password = 'mama';
        $user->role = 'profesor';
        $user->save();

        $curso = new Curso;
        $curso->codigo = 'ARIT06PRIM';
        $curso->nombre = 'aritmetica';
        $curso->id_profesor = '1';
        $curso->id_aula = '6';
        $curso->save();

        $curso = new Curso;
        $curso->codigo = 'ALGE06PRIM';
        $curso->nombre = 'algebra';
        $curso->id_profesor = '1';
        $curso->id_aula = '6';
        $curso->save();


        $curso = new Curso;
        $curso->codigo = 'GEO06PRIM';
        $curso->nombre = 'geometria';
        $curso->id_profesor = '1';
        $curso->id_aula = '6';
        $curso->save();


        $curso = new Curso;
        $curso->codigo = 'TRIGO06PRIM';
        $curso->nombre = 'trigonometria';
        $curso->id_profesor = '1';
        $curso->id_aula = '6';
        $curso->save();

        $bimestre = new Bimestre;
        $bimestre->num_bimestre = '1';
        $bimestre->bimestre = 'Primer';
        $bimestre->save();

        $bimestre = new Bimestre;
        $bimestre->num_bimestre = '2';
        $bimestre->bimestre = 'Segundo';
        $bimestre->save();

        $bimestre = new Bimestre;
        $bimestre->num_bimestre = '3';
        $bimestre->bimestre = 'Tercer';
        $bimestre->save();

        $bimestre = new Bimestre;
        $bimestre->num_bimestre = '4';
        $bimestre->bimestre = 'Cuarto';
        $bimestre->save();

        $evaluacion = new Evaluacion;
        $evaluacion->evaluacion = 'Práctica';
        $evaluacion->save();

        $evaluacion = new Evaluacion;
        $evaluacion->evaluacion = 'Exámen Mensual';
        $evaluacion->save();

        $evaluacion = new Evaluacion;
        $evaluacion->evaluacion = 'Exámen Bimestral';
        $evaluacion->save();


    }

}
