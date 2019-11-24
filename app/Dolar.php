<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dolar extends Model
{
	protected $table = "dolar";
    protected $fillable = ["valor","permitir"];
    public $incrementing = false;
    public $timestamps = false;
}
