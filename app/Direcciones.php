<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direcciones extends Model
{
    //
    protected $primaryKey = 'Correo_id';
    protected $table = 'Direcciones';
    protected $fillable = ['Correo_id','Calle','Colonia','CP'];
    public $incrementing = false;
    public $timestamps = false;

    public function Usuarios(){
    	return $this->belongsTo('App\Usuarios');
    }
}
