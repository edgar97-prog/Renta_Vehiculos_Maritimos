<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rol;

class RolesController extends Controller
{
    //
    public function todo()
    {
    	$roles = rol::all();
    	return view('welcome',compact('roles'));
    }
    
}
