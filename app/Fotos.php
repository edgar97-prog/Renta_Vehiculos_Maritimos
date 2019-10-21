<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotos extends Model
{
    //
    protected $primaryKey = "id";
    protected $table = "Fotos";
    protected $fillable = ["Foto","vehiculos_id"];
    public $timestamps = false;

    public function Vehiculos(){
    	return $this->belongsTo("App\Vehiculos");
    }
}
