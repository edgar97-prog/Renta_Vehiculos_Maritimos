<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model
{
    //
    private $primaryKey = ["Vehiculo_id","Correo_id"];
    private $table = "Favoritos";
    private $fillable = ["Vehiculo_id","Correo_id"];

}
