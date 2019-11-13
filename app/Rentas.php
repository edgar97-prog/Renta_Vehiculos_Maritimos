<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rentas extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'Rentas';
    protected $fillable = ['Correo_id','vehiculos_id','fechaFin','estatus'];
    
    public function Usuario()
    {
    	return $this->belongsTo(Usuarios::class);
    }

    public function Vehiculo()
    {
    	return $this->belongsTo(Vehiculos::class);
    }
}
