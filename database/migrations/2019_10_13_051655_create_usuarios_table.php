<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->String('Correo','50')->primary();
            $table->String('Contra','25');
            $table->String('Nombre','20');
            $table->String('ApellidoP','20');
            $table->String('ApellidoM','20');
            $table->Char('Sexo','1');
            $table->bigInteger('rol_id')->unsigned();

            $table->foreign('rol_id')->references('id')->on('roles')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
