<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->integer('dni');
            $table->string('primer_nombre',15);
            $table->string('segundo_nombre',15);
            $table->string('apellido_paterno',15);
            $table->string('apellido_materno',15);
            $table->unsignedBigInteger('id_aula');
            $table->integer('telefono');
            $table->string('email',100);
            $table->string('direccion',100);
            $table->string('foto_perfil',100);
            $table->string('genero',15);
            $table->string('password');
            $table->timestamps();

            $table->foreign('id_aula')->references('id')->on('aulas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
