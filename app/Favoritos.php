<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model
{
    //
    protected $primaryKey = ["Vehiculo_id","Correo_id"];
    protected $table = "Favoritos";
    protected $fillable = ["Vehiculo_id","Correo_id"];

    public function Usuario()
    {
    	return $this->belongsTo(Usuarios::class,'Correo_id','Correo');
    }


    public function Vehiculos()
    {
    	return $this->belongsTo(Vehiculos::class,'Vehiculo_id','id');
    }

}
