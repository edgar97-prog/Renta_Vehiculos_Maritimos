<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    //
    protected $id = ['id'];
    protected $fillable = ['correoUser_id','comentario'];
    protected $table = 'comentarios';
    protected $guarded = ['id'];

    public function Usuario()
    {
    	return $this->belongsTo(Usuarios::class,'correoUser_id','Correo');
    }
}
