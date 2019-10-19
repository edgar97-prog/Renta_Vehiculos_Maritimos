<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->bigInteger('Vehiculo_id')->unsigned();
            $table->String('Correo_id','50');
            $table->primary(["Vehiculo_id","Correo_id"]);
            $table->foreign('Vehiculo_id')->references('id')->on('Vehiculos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('Correo_id')->references('Correo')->on('Usuarios')
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
        Schema::dropIfExists('favoritos');
    }
}
