<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model
{
    //
    protected $primaryKey = "id";
    protected $table = "Vehiculos";
    protected $fillable = ["Nombre","Descripcion","precioRenta","precioDescuento","Descuento","tipoVehiculos_id","horasRenta","num_personas"];
    public $timestamps = false;

    public function Fotos()
    {
    	return $this->hasMany("App\Fotos");
    }

    public function Usuarios()
    {
    	return $this->belongsToMany("App\Usuarios");
    }

    public function TipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculos::class,'tipoVehiculos_id');
    }

    public function Favoritos()
    {
        return $this->hasMany(Favoritos::class,'Vehiculo_id');
    }
    public function Rentas()
    {
        return $this->hasMany(Rentas::class,'Correo_id');
    }
}