<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model
{
    //
    private $primaryKey = "id";
    private $table = "Vehiculos";
    private $fillable = ["Nombre","Descripcion","precioRenta","Cantidad"];

    public function Fotos()
    {
    	return $this->hasMany("App\Fotos");
    }

    public function Usuarios()
    {
    	return $this->belongsToMany("App\Usuarios");
    }
}
