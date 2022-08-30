<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->integer('cedula_identidad');
            $table->string('complemento', 2);
            $table->string('expedido', 2);
            $table->string('nombre', 100);
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50);
            $table->date('fecha_nacimiento');
            $table->string('nacionalidad');
            $table->string('estado_civil', 20);
            $table->string('genero', 10);
            $table->string('direccion', 250);
            $table->string('correo_electronico', 50);
            $table->integer('celular');
            $table->string('foto_selfie');
            $table->string('foto_ci_anverso');
            $table->string('foto_ci_reverso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
