<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model
{
    //
    protected $primaryKey = ["Vehiculo_id","Correo_id"];
    protected $table = "Favoritos";
    protected $fillable = ["Vehiculo_id","Correo_id"];

}
