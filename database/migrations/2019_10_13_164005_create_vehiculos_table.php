<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('Nombre','30');
            $table->String('Descripcion','255');
            $table->Float('precioRenta')->unsigned();
            $table->Float('precioDescuento')->unsigned()->nullable();
            $table->String('Descuento','5');
            $table->smallInteger('Cantidad')->unsigned();
            $table->bigInteger('tipoVehiculos_id')->unsigned();
            $table->foreign('tipoVehiculos_id')->references('id')->on('tipoVehiculos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
