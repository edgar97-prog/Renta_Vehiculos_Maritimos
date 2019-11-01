<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefonos extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'Telefonos';
    protected $fillable = ['Telefono','Usuario_id'];
	public $timestamps = false;
    
    public function Usuario(){
    	return $this->belongsTo(Usuarios::class);
    }
}
