<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Aula;

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
        $user->name = 'Admin';
        $user->email = 'joseperu2503@gmail.com';
        $user->password = '1234';
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

        $aula->save();
        $aula = new Aula;
        $aula->codigo = '02SEC';
        $aula->grado = 'segundo año';
        $aula->nivel = 'secundaria';
        $aula->abreviatura = '2°';

        $aula->save();

        $aula->save();
        $aula = new Aula;
        $aula->codigo = '03SEC';
        $aula->grado = 'tercer año';
        $aula->nivel = 'secundaria';
        $aula->abreviatura = '3°';

        $aula->save();

        $aula->save();
        $aula = new Aula;
        $aula->codigo = '04SEC';
        $aula->grado = 'cuarto año';
        $aula->nivel = 'secundaria';
        $aula->abreviatura = '4°';

        $aula->save();

        $aula->save();
        $aula = new Aula;
        $aula->codigo = '05SEC';
        $aula->grado = 'quinto año';
        $aula->nivel = 'secundaria';
        $aula->abreviatura = '5°';

        $aula->save();


    }

}
