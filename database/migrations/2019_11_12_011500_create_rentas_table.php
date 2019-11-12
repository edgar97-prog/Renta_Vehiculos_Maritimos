<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('Correo_id','50');
            $table->bigInteger('Vehiculo_id')->unsigned();
            $table->date("fechaFin");
            $table->String('estatus','1');
            $table->timestamps();

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
        Schema::dropIfExists('rentas');
    }
}
