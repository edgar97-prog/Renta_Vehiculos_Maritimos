<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model
{
    //
    protected $primaryKey = ["Vehiculo_id","Correo_id"];
    protected $table = "Favoritos";
    protected $fillable = ["Vehiculo_id","Correo_id"];
    public $incrementing = false;
    public $timestamps = false;

    public function Usuario()
    {
    	return $this->belongsTo(Usuarios::class);
    }


    public function Vehiculo()
    {
    	return $this->belongsTo(Vehiculos::class);
    }

}
