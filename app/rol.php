<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'roles';
    protected $fillable = ['Descripcion'];
}
