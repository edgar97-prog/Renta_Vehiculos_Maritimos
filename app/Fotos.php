<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotos extends Model
{
    //
    private $primaryKey = "id";
    private $table = "Fotos";
    private $fillable = ["Fotos","Vehiculo_id"];

    public function Vehiculos(){
    	return $this->belongsTo("App\Vehiculos");
    }
}
