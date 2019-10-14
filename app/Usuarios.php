<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    //
    protected $primaryKey = 'Correo';
    protected $table = 'Usuarios';
    protected $fillable = ['Correo','Contra','Nombre','ApellidoP','ApellidoM','Sexo','rol_id'];
    public $incrementing = false;
    public $timestamps = false;

    public function rol(){
    	return $this->belongsTo(rol::class);
    }
    public  function Vehiculos()
    {
    	return $this->belongsToMany("App\Vehiculos");
    }
}
