<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoVehiculos extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'tipovehiculos';
    public $timestamps = false;

    public function Vehiculos()
    {
    	return $this->hasMany(Vehiculos::class);
    }
}
