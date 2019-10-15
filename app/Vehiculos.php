<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model
{
    //
    protected $primaryKey = "id";
    protected $table = "Vehiculos";
    protected $fillable = ["Nombre","Descripcion","precioRenta","Cantidad"];
    public $timestamps = false;

    public function Fotos()
    {
    	return $this->hasMany("App\Fotos");
    }

    public function Usuarios()
    {
    	return $this->belongsToMany("App\Usuarios");
    }
}
